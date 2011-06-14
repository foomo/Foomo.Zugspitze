<?php

namespace Foomo\Zugspitze;

class ScaffoldTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Scaffold
	 */
	private $scaffold;

	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
		$this->scaffold = new \Foomo\Zugspitze\Scaffold(\Foomo\Zugspitze\Module::getVendorDir());
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testGetLibraries()
	{
		$libraries = $this->scaffold->getLibraries();
		$this->assertEquals(\Foomo\Zugspitze\TestSuite::LIBRARY_COUNT, count($libraries));
		//trigger_error(\var_export(array_keys($libraries), true));

		$libraries = $this->scaffold->getLibraries(false);
		$this->assertEquals(\Foomo\Zugspitze\TestSuite::LIBRARY_COUNT + 1, count($libraries));
		//trigger_error(\var_export(array_keys($libraries), true));
	}

	public function testGetProjects()
	{
		$projects = $this->scaffold->getProjects(\Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID);
		$this->assertNotEquals(0, count($projects));
		#\var_dump($projects);
	}

	public function testGetApplications()
	{
		$projects = $this->scaffold->getApplications(\Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID);
		$this->assertNotEquals(0, count($projects));
		#\var_dump($projects);
	}

	public function testGetGenerator()
	{
		$generator = $this->scaffold->getGenerator(\Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID, \Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID, \Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_APPLICATION_ID, \Foomo\Zugspitze\TestSuite::TEST_PACKAGE);
		$generator->render();
		$generator->createPackage();

		$baseDir = \Foomo\Zugspitze\Module::getTmpDir('Foomo\Zugspitze\Scaffold\Generator');
		$workingDir = $baseDir . DIRECTORY_SEPARATOR . \Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID . '_' . \Foomo\Zugspitze\TestSuite::TEST_PACKAGE;
		$workingDirTgz = $workingDir . '.tgz' ;

		$this->assertTrue(\file_exists($baseDir));
		$this->assertTrue(\file_exists($workingDir));
		$this->assertTrue(\file_exists($workingDirTgz));
	}
}