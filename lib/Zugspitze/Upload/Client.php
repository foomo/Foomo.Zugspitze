<?php

namespace Zugspitze\Upload;

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
	 * @return Zugspitze\Services\Upload\Reference[] 
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
		
		$url = $server . \Foomo\ROOT_HTTP . '/modules/' . \Zugspitze\Module::NAME . '/upload.php';
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
			$uploadRef = new \Zugspitze\Services\Upload\Reference();
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