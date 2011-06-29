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

namespace Foomo\Zugspitze\Services;

/**
 * support for chunked file uploads
 *
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author jan <jan@bestbytes.de>
 */
class Upload
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const VERSION = 0.1;

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * chunked upload
	 *
	 * @param string $chunk base64 encoded chunk
	 * @param integer $totalLength length of the file to be uploaded
	 * @param string $uploadName basename of the file on the client
	 * @param string $uploadId null to start a new upload, the upload id as returned from previous calls to continue an upload
	 * @return Foomo\Zugspitze\Services\Upload\Info
	 */
	public function chunkUpload($chunk, $totalLength, $uploadName, $uploadId=null)
	{
		if (empty($uploadId)) {
			$filename = tempnam(\Foomo\Zugspitze\Module::getTempDir(), 'upload_');
			$fp = fopen($filename, 'w');
		} else {
			$filename = \Foomo\Zugspitze\Module::getTempDir() . DIRECTORY_SEPARATOR . basename($uploadId);
			if (!file_exists($filename)) throw new \Exception('File ' . $filename . ' does not exist!');
			$fp = fopen($filename, 'a');
		}

		if ($fp === FALSE)  throw new \Exception('Could not open ' . $filename . '!');

		$data = base64_decode($chunk);
		fwrite($fp, $data);
		fclose($fp);
		clearstatcache();

		$uploadInfo = new \Foomo\Zugspitze\Services\Upload\Info(basename($filename));
		$uploadInfo->uploadSessionId = session_id();
		$uploadInfo->uploadIp = $_SERVER['REMOTE_ADDR'];
		$uploadInfo->name = $uploadName;
		$uploadInfo->size = filesize($filename);
		if ($uploadInfo->size >= $totalLength) {
			$uploadInfo->mimeType = \Foomo\Utils::guessMime($filename);
			$uploadInfo->tempName = $filename;
			$uploadInfo->persist();
		}
		return $uploadInfo;
	}

	/**
	 * Cancel an already started chunkUpload
	 *
	 * @param string $uploadId
	 * @return boolean
	 */
	public function cancelChunkUpload($uploadId)
	{
		if ($uploadId) {
			$filename = \Foomo\Config::getTempDir() . DIRECTORY_SEPARATOR . basename($uploadId);
			if (file_exists($filename)) unlink($filename);
		}
		return true;
	}
}