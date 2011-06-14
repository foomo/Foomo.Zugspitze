<?php

namespace Foomo\Zugspitze\Services;

class ScaffoldTest extends \PHPUnit_Framework_TestCase 
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------
	
	const FLEX4_EXAMPLES_PROJECT_ID			= 'org.foomo.zugspitze.flex4.examples';
	const FLEX4_LIBRARY_ID					= 'org.foomo.zugspitze.flex4';
	
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Services\Scaffold
	 */
	private $service;
	
	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------
	
	public function setUp()
	{
		$this->service = new \Foomo\Zugspitze\Services\Scaffold();
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testGetLibraries()
	{
		$libraries = $this->service->getLibraries();
		$this->assertNotEquals(0, count($libraries));
		#\var_dump($libraries);
	}

	public function testGetProjects()
	{
		$projects = $this->service->getProjects(self::FLEX4_LIBRARY_ID);
		$this->assertNotEquals(0, count($projects));
		#\var_dump($projects);
	}
	
	public function testGetApplications()
	{
		$applications = $this->service->getApplications(self::FLEX4_EXAMPLES_PROJECT_ID);
		$this->assertNotEquals(0, count($applications));
		#\var_dump($applications);
	}
}