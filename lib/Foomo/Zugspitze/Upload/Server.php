<?php

/*
 * This file is part of the foomo Opensource Framework.
 *
 * The foomo Opensource Framework is free software: you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General Public License as
 * published  by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * The foomo Opensource Framework is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along with
 * the foomo Opensource Framework. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Foomo\Zugspitze\Upload;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author jan <jan@bestbytes.de>
 */
class Server
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	/**
	 * @var integer
	 */
	public static $uploadLimit = 10;

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * used to "serve" upload functionality
	 */
	public static function serve()
	{
		if (count($_FILES)) {
			$ids = array();
			foreach ($_FILES as $id => $uploadArray) {
				$uploadInfo = tempnam(\Foomo\Zugspitze\Module::getTempDir(), 'upload-');
				$id = basename($uploadInfo);
				move_uploaded_file($uploadArray['tmp_name'], $uploadInfo);
				$uploadArray['tmp_name'] = $uploadInfo;
				$upload = new \Foomo\Zugspitze\Services\Upload\Info($id, $uploadArray);

				if ($upload->error !== 0) trigger_error('there was an upload error ' . var_export($upload, true), E_USER_WARNING);

				$upload->uploadSessionId = session_id();
				$upload->uploadIp = $_SERVER['REMOTE_ADDR'];
				$upload->mimeType = \Foomo\Utils::guessMime($uploadInfo);
				$upload->persist();
				$ids[] = $id;
			}
			echo implode(PHP_EOL, $ids);
		} else {
			self::reflectUploadedFile();
		}
	}

	/**
	 *
	 */
	private static function reflectUploadedFile()
	{
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$ref = self::getUpload($id);
			if (!is_null($ref) && $ref instanceof \Foomo\Zugspitze\Services\Upload\Info) {

				# validate time difference
				$diff = (time() - $ref->uploadTime);
				if ($diff > self::$uploadLimit) trigger_error('access to file upload references is limited to ' . self::$uploadLimit . ' seconds ater the upload time passed: ' . $diff, E_USER_ERROR);

				# validate client ip
				if ($ref->uploadIp != $_SERVER['REMOTE_ADDR']) trigger_error('access to uploaded file with client IP', E_USER_ERROR);

				# stream file
				\Foomo\Utils::streamFile($ref->tempName, $ref->name, $ref->mimeType, (!empty($_GET['d'])));
			}
		}
	}

	/**
	 * try to get a previously uploaded file
	 *
	 * @param string $uploadId
	 * @return Foomo\Zugspitze\Services\Upload\File
	 */
	public static function getUpload($uploadId)
	{
		return \Foomo\Zugspitze\Services\Upload\Info::load($uploadId);
	}
}