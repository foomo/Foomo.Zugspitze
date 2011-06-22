<?php

namespace Foomo\Zugspitze\Services;

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
	 * @var Foomo\Zugspitze\Scaffolding
	 */
	private $sources;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		$this->sources = new \Foomo\Zugspitze\Scaffold(\Foomo\Zugspitze\Module::getVendorDir());
	}

	//---------------------------------------------------------------------------------------------
	// ~ Service methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return Foomo\Zugspitze\Services\Scaffold\Library[]
	 */
	public function getLibraries()
	{
		$result = array();
		foreach (\Foomo\Zugspitze\Vendor::getSources()->getLibraryProjects() as $project) {
			/* @var  $library Foomo\Zugspitze\Vendor\Sources\Project */
			$obj = new \Foomo\Zugspitze\Services\Scaffold\Library();
			$obj->id = $project->id;
			$obj->name = $project->name;
			$obj->description = $project->description;
			$result[] = $obj;
		}
		return $result;
	}

	/**
	 * @return Foomo\Zugspitze\Services\Scaffold\Project[]
	 */
	public function getProjects($libraryProjectId)
	{
		$result = array();
		foreach (\Foomo\Zugspitze\Vendor::getSources()->getImplementationProjects($libraryProjectId) as $project) {
			/* @var  $library Foomo\Zugspitze\Vendor\Sources\Project */
			$obj = new \Foomo\Zugspitze\Services\Scaffold\Project();
			$obj->id = $project->id;
			$obj->name = $project->name;
			$obj->description = $project->description;
			$result[] = $obj;
		}
		return $result;
	}

	/**
	 * @return Foomo\Zugspitze\Services\Scaffold\Application[]
	 */
	public function getApplications($implementationProjectId)
	{
		$result = array();
		foreach (\Foomo\Zugspitze\Vendor::getSources()->getImplementationProjectApplications($implementationProjectId) as $application) {
			/* @var  $library Foomo\Zugspitze\Vendor\Sources\Application */
			$obj = new \Foomo\Zugspitze\Services\Scaffold\Application();
			$obj->id = $application->id;
			$obj->name = $application->name;
			$obj->description = $application->description;
			$result[] = $obj;
		}
		return $result;
	}
}