<?php

namespace Foomo\Zugspitze;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testGetLibraryGeneratorConfig()
	{
		$config = Module::getLibraryGeneratorConfig();
		$this->assertNotNull($config);
	}

	public function testGetFlexConfig()
	{
		$config = Module::getFlexConfig();
		$this->assertNotNull($config);
	}
}