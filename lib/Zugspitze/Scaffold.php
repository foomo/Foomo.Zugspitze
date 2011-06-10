<?php

namespace Zugspitze;

class Scaffold {
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @var string
	 */
	public $pathname;
	/**
	 * @var Zugspitze\Scaffold\Library[]
	 */
	public $libraries;
	/**
	 * @var Zugspitze\Scaffold\Project[]
	 */
	public $projects;
	/**
	 * @var Zugspitze\Scaffold\Application[]
	 */
	public $applications;
	
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $pathname 
	 */
	public function __construct($pathname)
	{
		$this->pathname = $pathname;
		$this->scan();
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @param boolean $all	Include excluded resources
	 * @return Zugspitze\Scaffold\Library[]
	 */
	public function getLibraries($exclude=true)
	{
		$data = array();
		foreach ($this->libraries as $id => $library) {
			if ($exclude && $library->exclude) continue;
			$data[$id] = $library;
		}
		return $data;
	}
	
	/**
	 * @param boolean $all	Include excluded resources
	 * @return Zugspitze\Scaffold\Project[]
	 */
	public function getProjects($libraryId, $exclude=true)
	{
		$data = array();
		foreach ($this->projects[$libraryId] as $id => $project) {
			if ($exclude && $project->exclude) continue;
			$data[$id] = $project;
		}
		return $data;
	}	
	
	/**
	 * @param boolean $all	Include excluded resources
	 * @return Zugspitze\Scaffold\Application[]
	 */
	public function getApplications($projectId)
	{
		$data = array();
		foreach ($this->applications[$projectId] as $id => $application) {
			$data[$id] = $application;
		}
		return $data;
	}
	
	/**
	 * @param string $libraryId
	 * @param string $projectId
	 * @param string $applicationId
	 * @param string $package 
	 * @return Zugspitze\Scaffold\Generator;
	 */
	public function getGenerator($libraryId, $projectId, $applicationId, $package)
	{
		$library = $this->libraries[$libraryId];
		$project = $this->projects[$libraryId][$projectId];
		$application = $this->applications[$projectId][$applicationId];
		return new \Zugspitze\Scaffold\Generator($library, $project, $application, $package);
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * Scans the vendor folder
	 */
	private function scan()
	{
		$dirs = \scandir($this->pathname);
		
		foreach ($dirs as $dir) {
			$pathname = $this->pathname . '/' . $dir;
			
			if (\in_array($dir, array('.', '..', '.svn', '.git'))) continue;
			if (!\is_dir($pathname)) continue;
			
			# get config files
			$config = $this->getConfig($pathname);
			
			if ($config->type == \Zugspitze\Scaffold\Config::TYPE_CORE_LIBRARY) {
				# validate id
				if (isset($this->libraries[$config->id])) throw new \Exception($config->id . ' already exists!');
				# create object
				$this->libraries[$config->id] = new \Zugspitze\Scaffold\Library(
					$config->id, 
					$config->name, 
					$config->description, 
					$config->dependencies, 
					$config->exclude, 
					$pathname
				);
			} else if ($config->type == \Zugspitze\Scaffold\Config::TYPE_IMPLEMENTATION_PROJECT) {
				# create package
				if (!isset($this->projects[$config->getLastDependencyId()])) $this->projects[$config->getLastDependencyId()] = array();
				# validate id
				if (isset($this->projects[$config->getLastDependencyId()][$config->id])) throw new \Exception($config->id . ' already exists!');
				# create object
				$this->projects[$config->getLastDependencyId()][$config->id] = new \Zugspitze\Scaffold\Project(
					$config->id, 
					$config->name, 
					$config->description, 
					$config->dependencies, 
					$config->exclude, 
					$pathname
				);
				# get applications
				foreach ($config->applications as $applicationConfig) {
					# create package
					if (!isset($this->applications[$config->id])) $this->applications[$config->id] = array();
					# validate id
					if (isset($this->applications[$config->id][$applicationConfig->id])) throw new \Exception($applicationConfig->id . ' already exists!');
					# create object
					$this->applications[$config->id][$applicationConfig->id] = new \Zugspitze\Scaffold\Application(
						$applicationConfig->id, 
						$applicationConfig->name, 
						$applicationConfig->description, 
						$applicationConfig->package, 
						$applicationConfig->exclude, 
						$applicationConfig->sources, 
						$applicationConfig->externals, 
						$pathname
					);
				}
			} else {
				throw new \Exception('Unknown type "' . $config->type . '"');
			}
		}
	}	
	
	/**
	 * @param string $pathname
	 * @return Zugspitze\Scaffold\Config
	 */
	private function getConfig($pathname)
	{
		$xml = $pathname . '/resources/configs/zugspitze-scaffold.xml';
		if ((!\file_exists($xml))) throw new \Exception('Vendor  ' . $pathname . ' does not contain a /resources/configs/zugspitze-scaffold.xml file!' . $xml);
		return \Zugspitze\Scaffold\Config::parseXML($xml);
	}	
}