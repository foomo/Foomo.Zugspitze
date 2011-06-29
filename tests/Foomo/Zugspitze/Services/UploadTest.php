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
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author jan <jan@bestbytes.de>
 */
class UploadTest extends \PHPUnit_Framework_TestCase
{

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Services\Upload
	 */
	private $service;

	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
		if(php_sapi_name() == 'cli') {
			$this->markTestSkipped('will not run this test on the command line');
		}

		$this->service = new \Foomo\Zugspitze\Services\Upload();
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

		// ergebnis pr√ºfen
		$this->assertEquals(basename($filename), $fileInfo->name, "Filename should match");
		$this->assertEquals($filesize, $fileInfo->size, "Filesize should match");
		$this->assertEquals(md5_file($filename), md5_file($fileInfo->tempName), "md5 hash on files should match");
		unlink($fileInfo->tempName);

		// try to get info from cache
		$ret = \Foomo\Zugspitze\Upload\Server::getUpload($fileId);
		$this->assertNotNull($fileInfo, "\Zugspitze\Upload::getUpload($fileId) shouldn't return null");
		$this->assertEquals($fileInfo, $ret, "\Zugspitze\Upload::getUpload($fileId) should return same info");
	}
}