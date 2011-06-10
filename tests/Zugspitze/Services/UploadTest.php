<?php

namespace Zugspitze\Services;

class UploadTest extends \PHPUnit_Framework_TestCase 
{
	
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Zugspitze\Services\Upload
	 */
	private $service;
	
	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------
	
	public function setUp()
	{
		$this->service = new \Zugspitze\Services\Upload();
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------
	
	public function testChunkUpload()
	{
		$chunkSize = 100;
		$filename  = __FILE__;
		$filesize  = filesize($filename);
		$data      = file_get_contents($filename);
		$fileId    = null;
		
		// in schleife hochladen
		for ($pos = 0; $pos < $filesize; $pos += $chunkSize) {
			$fileInfo = $this->service->chunkUpload(base64_encode(substr($data, $pos, $chunkSize)), $filesize, basename($filename), $fileId);
			$this->assertNotNull($fileInfo, "chunkUpload(..) shouldn't return null");
			$fileId = $fileInfo->id;
			$this->assertNotNull($fileId);
		}
		
		// ergebnis prüfen
		$this->assertEquals(basename($filename), $fileInfo->name, "Filename should match");
		$this->assertEquals($filesize, $fileInfo->size, "Filesize should match");
		$this->assertEquals(md5_file($filename), md5_file($fileInfo->tempName), "md5 hash on files should match");
		unlink($fileInfo->tempName);
		
		// try to get info from cache
		$ret = \Zugspitze\Upload\Server::getUpload($fileId);
		$this->assertNotNull($fileInfo, "\Zugspitze\Upload::getUpload($fileId) shouldn't return null");
		$this->assertEquals($fileInfo, $ret, "\Zugspitze\Upload::getUpload($fileId) should return same info");
	}
}