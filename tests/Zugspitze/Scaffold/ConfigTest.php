<?php
namespace Zugspitze\Scaffold;

class ConfigTest extends \PHPUnit_Framework_TestCase 
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
	
	public function testParseCoreLibraryXML()
	{
		$config = \Zugspitze\Scaffold\Config::parseXML(\Zugspitze\Module::getVendorDir() . '/core/resources/configs/zugspitze-scaffold.xml');
		$this->assertNotEquals('', $config->id);
		$this->assertNotEquals('', $config->type);
		$this->assertNotEquals('', $config->name);
		$this->assertNotEquals('', $config->description);
		$this->assertEquals(1, count($config->dependencies));
		$this->assertEquals(0, count($config->applications));
		$this->assertTrue($config->exclude);
		#\var_dump($config);
	}
	
	public function testParseFlex4LibraryXML()
	{
		$config = \Zugspitze\Scaffold\Config::parseXML(\Zugspitze\Module::getVendorDir() . '/flex4/resources/configs/zugspitze-scaffold.xml');
		$this->assertNotEquals('', $config->id);
		$this->assertNotEquals('', $config->type);
		$this->assertNotEquals('', $config->name);
		$this->assertNotEquals('', $config->description);
		$this->assertEquals(1, count($config->dependencies));
		$this->assertEquals(0, count($config->applications));
		$this->assertFalse($config->exclude);
		#\var_dump($config);
	}
	
	public function testParseFlex4ExampleXML()
	{
		$config = \Zugspitze\Scaffold\Config::parseXML(\Zugspitze\Module::getVendorDir() . '/flex4Examples/resources/configs/zugspitze-scaffold.xml');
		$this->assertNotEquals('', $config->id);
		$this->assertNotEquals('', $config->type);
		$this->assertNotEquals('', $config->name);
		$this->assertNotEquals('', $config->description);
		$this->assertEquals(2, count($config->dependencies));
		$this->assertNotEquals(0, count($config->applications));
		$this->assertFalse($config->exclude);
		
		foreach ($config->applications as $application) {
			$this->assertNotEquals('', $application->id);
			$this->assertNotEquals('', $application->name);
			$this->assertNotEquals('', $application->description);
			$this->assertNotEquals('', $application->package);
			$this->assertFalse($application->exclude);
			$this->assertNotEquals(0, count($application->sources));
		}
		
		#\var_dump($config);
	}
}