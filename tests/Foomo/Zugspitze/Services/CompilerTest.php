<?php

namespace Foomo\Zugspitze\Services;

use PHPUnit_Framework_TestCase;

/**
 * Description of ZSCompilerServiceTestclass
 *
 * @author jan
 */
class CompilerTest extends PHPUnit_Framework_TestCase {
	/**
	 * me service
	 * 
	 * @var ZSCompilerService
	 */
	private $service;
	public function setUp()
	{
		if(php_sapi_name() == 'cli') {
			$this->markTestSkipped('will not run this test on the command line');
		}
		$this->service = new Compiler;
	}
	public function testGetServices()
	{
		$services = $this->service->getServices();
		$this->assertInstanceOf('Foomo\\Zugspitze\\Services\\Compiler\\ModuleInfo', $services[0]);
	}
}
