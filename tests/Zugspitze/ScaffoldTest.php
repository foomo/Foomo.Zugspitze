<?php

namespace Zugspitze;

class ScaffoldTest extends \PHPUnit_Framework_TestCase 
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------
	
	const LIBRARY_COUNT						= 6;
	const FLEX4_LIBRARY_ID					= 'com.bestbytes.zugspitze.flex4';
	const FLEX4_EXAMPLES_PROJECT_ID			= 'com.bestbytes.zugspitze.flex4.examples';
	const FLEX4_EXAMPLES_APPLICATION_ID		= 'com.bestbytes.zugspitze.flex4.examples.applications.blank';
	const PACKAGE							= 'com.bestbytes.tests.applications.blank';
	
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Zugspitze\Scaffold
	 */
	private $scaffold;
		
	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------
	
	public function setUp()
	{
		$this->scaffold = new \Zugspitze\Scaffold(\Zugspitze\Module::getVendorDir());
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------
	
	public function testGetLibraries()
	{
		$libraries = $this->scaffold->getLibraries();
		$this->assertEquals(self::LIBRARY_COUNT, count($libraries));
		#\var_dump($libraries);
		
		$libraries = $this->scaffold->getLibraries(false);
		$this->assertEquals(self::LIBRARY_COUNT + 1, count($libraries));
		#\var_dump($libraries);
	}

	public function testGetProjects()
	{
		$projects = $this->scaffold->getProjects(self::FLEX4_LIBRARY_ID);
		$this->assertNotEquals(0, count($projects));
		#\var_dump($projects);
	}	
	
	public function testGetApplications()
	{
		$projects = $this->scaffold->getApplications(self::FLEX4_EXAMPLES_PROJECT_ID);
		$this->assertNotEquals(0, count($projects));
		#\var_dump($projects);
	}	
	
	public function testGetGenerator()
	{
		$generator = $this->scaffold->getGenerator(self::FLEX4_LIBRARY_ID, self::FLEX4_EXAMPLES_PROJECT_ID, self::FLEX4_EXAMPLES_APPLICATION_ID, self::PACKAGE);
		$generator->render();
		$generator->createPackage();
		
		$baseDir = \Zugspitze\Module::getTmpDir('Zugspitze\Scaffold\Generator');
		$workingDir = $baseDir . DIRECTORY_SEPARATOR . self::FLEX4_LIBRARY_ID . '_' . self::PACKAGE;
		$workingDirTgz = $workingDir . '.tgz' ;
		
		$this->assertTrue(\file_exists($baseDir));
		$this->assertTrue(\file_exists($workingDir));
		$this->assertTrue(\file_exists($workingDirTgz));
	}
}