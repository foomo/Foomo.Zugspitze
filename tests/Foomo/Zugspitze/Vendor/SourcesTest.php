<?php

namespace Foomo\Zugspitze\Vendor;

class SourcesTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Vendor\Sources
	 */
	private $sources;

	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
		$this->sources = new \Foomo\Zugspitze\Vendor\Sources(\Foomo\Zugspitze\Module::getVendorDir() . '/sources');
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testUpdateProjects()
	{
		$this->sources = new \Foomo\Zugspitze\Vendor\Sources(\Foomo\Zugspitze\Module::getVendorDir() . '/sources', false);
		$this->assertTrue((count($this->sources->getLibraryProjects()) == 0));
		$this->sources->updateProjects();
		$this->assertFalse((count($this->sources->getLibraryProjects()) == 0));
	}

	public function testGetLibraryProject()
	{
		$library = $this->sources->getLibraryProject(\Foomo\Zugspitze\TestSuite::CORE_LIBRARY_ID);
		$this->assertNotNull($library);
	}

	public function testGetLibraryProjects()
	{
		$libraries = $this->sources->getLibraryProjects();
		$this->assertEquals(\Foomo\Zugspitze\TestSuite::LIBRARY_COUNT, count($libraries));
		//trigger_error(\var_export(array_keys($libraries), true));

		$libraries = $this->sources->getLibraryProjects(false);
		$this->assertEquals(\Foomo\Zugspitze\TestSuite::TOTAL_LIBRARY_COUNT, count($libraries));
		//trigger_error(\var_export(array_keys($libraries), true));
	}

	public function testGetImplementationProject()
	{
		$project = $this->sources->getImplementationProject(\Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID, \Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID);
		$this->assertNotNull($project);
	}

	public function testGetImplementationProjects()
	{
		$projects = $this->sources->getImplementationProjects(\Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID);
		$this->assertNotEquals(0, count($projects));
		#\var_dump($projects);
	}

	public function testGetImplementationProjectApplication()
	{
		$application = $this->sources->getImplementationProjectApplication(\Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID, \Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_APPLICATION_ID);
		$this->assertNotNull($application);
	}

	public function testGetImplementationProjectApplications()
	{
		$applications = $this->sources->getImplementationProjectApplications(\Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID);
		$this->assertNotEquals(0, count($applications));
		#\var_dump($projects);
	}

	public function testGetLibrary()
	{
		$library = $this->sources->getLibrary(\Foomo\Zugspitze\TestSuite::SERVICES_UPLOAD_LIBRARY_ID);
		$this->assertNotNull($library);
	}

	public function testGetLibraries()
	{
		$libraries = $this->sources->getLibraries();
		$this->assertTrue(count($libraries) > 0);
	}
}