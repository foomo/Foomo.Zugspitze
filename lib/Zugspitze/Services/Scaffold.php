<?php

namespace Zugspitze\Services;

class Scaffold
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const VERSION = 0.1;

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @var Zugspitze\Scaffolding
	 */
	private $scaffold;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------
	
	public function __construct()
	{
		$this->scaffold = new \Zugspitze\Scaffold(\Zugspitze\Module::getVendorDir());
	}

	//---------------------------------------------------------------------------------------------
	// ~ Service methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @return Zugspitze\Services\Scaffold\Library[] 
	 */
	public function getLibraries()
	{
		$result = array();
		$libraries = $this->scaffold->getLibraries();
		foreach ($libraries as $library) {
			$obj = new \Zugspitze\Services\Scaffold\Library();
			$obj->id = $library->id;
			$obj->name = $library->name;
			$obj->description = $library->description;
			$result[] = $obj;
		}
		return $result;
	}
	
	/**
	 * @return Zugspitze\Services\Scaffold\Project[] 
	 */
	public function getProjects($libraryId)
	{
		$result = array();
		$projects = $this->scaffold->getProjects($libraryId);
		foreach ($projects as $project) {
			$obj = new \Zugspitze\Services\Scaffold\Project();
			$obj->id = $project->id;
			$obj->name = $project->name;
			$obj->description = $project->description;
			$result[] = $obj;
		}
		return $result;
	}
	
	/**
	 * @return Zugspitze\Services\Scaffold\Application[] 
	 */
	public function getApplications($projectId)
	{
		$result = array();
		$applications = $this->scaffold->getApplications($projectId);
		foreach ($applications as $application) {
			$obj = new \Zugspitze\Services\Scaffold\Application();
			$obj->id = $application->id;
			$obj->name = $application->name;
			$obj->description = $application->description;
			$result[] = $obj;
		}
		return $result;
	}
}