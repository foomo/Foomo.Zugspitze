<?php

namespace Zugspitze;

class UploadTest extends \PHPUnit_Framework_TestCase 
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const SESSION_ID = 'UPLOAD-ID-SESSION';
	
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	private $workDir;
	private $targetFileA;
	private $targetFileB;
	private $sessionFile;

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------


	public function testUploadFiles()
	{
		$files = array(
			'a' => '@' . __FILE__,
			'b' => '@' . __FILE__
		);

		$serverReply = $this->postFiles($files);
		$uploadIds = explode(PHP_EOL, $serverReply);

		$me = file_get_contents(__FILE__);
		foreach ($uploadIds as $uploadId) {
			$upload = \Zugspitze\Upload\Server::getUpload($uploadId);
			if (is_null($upload)) {
				$this->fail('could not RadFileUploadServer::getUpload with id ' . $uploadId);
			}
			if (file_get_contents($upload->tempName) != $me) {
				$this->fail('upload with id ' . $uploadId . ' failed contents were not like me');
			}
		}
	}

	public function testUploadFilesToRemoteServer()
	{
		$files = array(__FILE__, __FILE__);
		$refs = \Zugspitze\Upload\Client::uploadFilesToRemoteServer($files);
		$me = file_get_contents(__FILE__);
		foreach ($refs as $uploadReference) {
			/* @var uploadReference RadFileUploadReference */
			$upload = \Zugspitze\Upload\Server::getUpload($uploadReference->id);

			if ($upload->name != $uploadReference->name) {
				$this->fail('names of upload and upload reference do not match "' . $upload->name . '" != "' . $uploadReference->name . '"');
			}
			if (!file_exists($upload->tempName)) {
				$this->fail('file was not uploaded - was expected at ' . $upload->tempName);
			}

			if (file_get_contents($upload->tempName) != $me) {
				$this->fail('file contents do not match ');
			}
		}
	}

	public function testReflectUploadedFileFailWrongSession()
	{
		$this->markTestSkipped();
		/*
		  $me = file_get_contents(__FILE__);
		  $ch = $this->uploadMeInASession();
		  \curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . self::SESSION_ID . '-not');
		  echo 'the fatal error on the server side is ok!';
		  $fileContents = \curl_exec($ch);
		  $this->assertNotEquals($me, $fileContents , 'reflection of the file with a wrong session should have failed');
		  \curl_close($ch);

		 */
	}

	public function testReflectUploadedFile()
	{
		$me = file_get_contents(__FILE__);
		$ch = $this->uploadMeInASession();
		$fileContents = \curl_exec($ch);
		$this->assertEquals($me, $fileContents, 'looks like the reflection failed');
	}

	public function testReflectUploadedFileFailTImeOut()
	{
		$me = file_get_contents(__FILE__);
		$ch = $this->uploadMeInASession();
		sleep(\Zugspitze\Upload\Server::$uploadLimit + 1);
		$fileContents = \curl_exec($ch);
		$this->assertNotEquals($me, $fileContents, 'there should have been a timeout');
	}

	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------


	/**
	 * @param array $files
	 * @return type 
	 */
	private function postFiles($files)
	{
		$post_data = array();
		$ch = \curl_init();
		$url = \Foomo\Utils::getServerUrl() . \Foomo\ROOT_HTTP . '/modules/' . \Zugspitze\Module::NAME . '/upload.php';
		\curl_setopt($ch, CURLOPT_URL, $url);
		\curl_setopt($ch, CURLOPT_POST, 1);
		\curl_setopt($ch, CURLOPT_POSTFIELDS, $files);
		\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$postResult = \curl_exec($ch);
		if (\curl_errno($ch)) throw new Exception('curl post failed ' . \curl_error($ch), 1);
		\curl_close($ch);
		return $postResult;
	}
	
	/**
	 * helper function upload a file in a session and return the curl handle with the session
	 *
	 * @return resource
	 */
	private function uploadMeInASession()
	{
		$files = array(__FILE__);
		$ch = \curl_init();
		\curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . self::SESSION_ID);
		$refs = \Zugspitze\Upload\Client::uploadFilesToRemoteServer($files, null, $ch);
		$me = file_get_contents(__FILE__);
		foreach ($refs as $uploadReference) $upload = \Zugspitze\Upload\Server::getUpload($uploadReference->id);
		$server = \Foomo\Utils::getServerUrl();
		$reflectionUrl = $server . \Foomo\ROOT_HTTP . '/modules/' . \Zugspitze\Module::NAME . '/upload.php?id=' . $uploadReference->id . '&d';
		\curl_setopt($ch, CURLOPT_POST, 0);
		\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		\curl_setopt($ch, CURLOPT_URL, $reflectionUrl);
		return $ch;
	}
}
