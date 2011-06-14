<?php

namespace Foomo\Zugspitze\Services;

/**
 * support for chunked file uploads
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
			$filename = tempnam(\Foomo\Zugspitze\Upload::getTmpDir(), 'upload_');
			$fp = fopen($filename, 'w');
		} else {
			$filename = \Foomo\Zugspitze\Upload::getTmpDir() . DIRECTORY_SEPARATOR . basename($uploadId);
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