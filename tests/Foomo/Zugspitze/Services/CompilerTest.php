<?php

namespace Foomo\Zugspitze\Services;

/**
 * Description of ZSCompilerServiceTestclass
 */
class CompilerTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Services\Compiler
	 */
	private $service;

	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
		if (php_sapi_name() == 'cli') $this->markTestSkipped('will not run this test on the command line');
		$this->service = new Compiler;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testGetServices()
	{
		$services = $this->service->getServices();
		$this->assertInstanceOf('Foomo\\Zugspitze\\Services\\Compiler\\ModuleInfo', $services[0]);
	}
}
