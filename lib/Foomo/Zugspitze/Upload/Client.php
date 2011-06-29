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
class Client
{
	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * upload files to a remote server - very handy for unit testing
	 *
	 * @param array $fileNames array of filenames to be uploaded
	 * @param string $server
	 * @param resource $ch
	 * @return Foomo\Zugspitze\Upload\UploadReference[]
	 */
	public static function uploadFilesToRemoteServer($fileNames, $server=null, $ch=null)
	{
		if (is_null($server)) $server = \Foomo\Utils::getServerUrl();

		$ret = array();
		$i = 0;
		$files = array();

		foreach ($fileNames as $fileName) {
			$files['upload_' . $i] = '@' . $fileName;
			$i++;
		}

		$post_data = array();

		if ($ch) {
			$saveCurlHandle = true;
		} else {
			$saveCurlHandle = false;
			$ch = curl_init();
		}

		$url = $server . \Foomo\ROOT_HTTP . '/modules/' . \Foomo\Zugspitze\Module::NAME . '/upload.php';
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $files);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		if (curl_errno($ch)) throw new Exception('curl post failed ' . curl_error($ch), 1);

		$postResult = explode(PHP_EOL, curl_exec($ch));

		if (!$saveCurlHandle) curl_close($ch);

		$i = 0;
		foreach ($postResult as $uploadId) {
			$fileName = $fileNames[$i];
			$uploadRef = new \Foomo\Zugspitze\Upload\UploadReference();
			$ret[] = $uploadRef;
			if (function_exists('posix_getpwuid')) {
				$userInfo = posix_getpwuid(fileowner($fileName));
				$uploadRef->creator = $userInfo['name'];
			} else {
				$uploadRef->creator = '---';
			}
			$uploadRef->modificationDate = filemtime($fileName);
			$uploadRef->name = basename($fileName);
			$uploadRef->size = filesize($fileName);
			$uploadRef->type = 'octet/stream';
			$uploadRef->id = $uploadId;
			$i++;
		}
		return $ret;
	}
}