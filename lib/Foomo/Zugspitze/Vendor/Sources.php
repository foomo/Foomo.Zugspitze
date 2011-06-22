<?php

namespace Foomo\Zugspitze\Vendor;

class Sources
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	private $pathname;
	/**
	 * @var Foomo\Zugspitze\Vendor\Sources\Project[]
	 */
	private $libraryProjects = array();
	/**
	 * @var Foomo\Zugspitze\Vendor\Sources\Project[]
	 */
	private $implementationProjects = array();
	/**
	 * @var Foomo\Zugspitze\Vendor\Sources\Application[]
	 */
	private $implementationProjectApplications = array();

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $pathname
	 */
	public function __construct($pathname, $update=true)
	{
		$this->pathname = $pathname;
		if ($update) $this->updateProjects();
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 *
	 */
	public function updateProjects()
	{
		$htis->libraryProjects = array();
		$htis->implementationProjects = array();
		$htis->implementationProjectApplications = array();
		$this->scan();
	}

	/**
	 * @param string $libraryProjectId
	 * @return Foomo\Zugspitze\Vendor\Sources\Project
	 */
	public function getLibraryProject($libraryProjectId)
	{
		return $this->libraryProjects[$libraryProjectId];
	}

	/**
	 * @param bool $exclude
	 * @return Foomo\Zugspitze\Vendor\Sources\Project[]
	 */
	public function getLibraryProjects($exclude=true)
	{
		$data = array();
		foreach ($this->libraryProjects as $projectId => $project) {
			if ($exclude && $project->exclude) continue;
			$data[$projectId] = $project;
		}
		return $data;
	}

	/**
	 * @param string $libraryProjectId
	 * @param string $implementationProjectId
	 * @return Foomo\Zugspitze\Vendor\Sources\Project
	 */
	public function getImplementationProject($libraryProjectId, $implementationProjectId)
	{
		return $this->implementationProjects[$libraryProjectId][$implementationProjectId];
	}

	/**
	 * @param string $libraryProjectId
	 * @param bool $exclude
	 * @return Foomo\Zugspitze\Vendor\Sources\Project[]
	 */
	public function getImplementationProjects($libraryProjectId, $exclude=true)
	{
		$data = array();
		foreach ($this->implementationProjects[$libraryProjectId] as $projectId => $project) {
			if ($exclude && $project->exclude) continue;
			$data[$projectId] = $project;
		}
		return $data;
	}

	/**
	 * @param string $implementationProjectId
	 * @param string $implementationProjectApplicationId
	 * @return Foomo\Zugspitze\Vendor\Sources\Application
	 */
	public function getImplementationProjectApplication($implementationProjectId, $implementationProjectApplicationId)
	{
		return $this->applications[$implementationProjectId][$implementationProjectApplicationId];
	}

	/**
	 * @param string $implementationProjectId
	 * @return Foomo\Zugspitze\Vendor\Sources\Application[]
	 */
	public function getImplementationProjectApplications($implementationProjectId)
	{
		$data = array();
		foreach ($this->applications[$implementationProjectId] as $applicationId => $application) {
			$data[$applicationId] = $application;
		}
		return $data;
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
			$project = $this->getProject($pathname);

			switch ($project->type) {
				case Sources\Project::TYPE_LIBRARY_PROJECT:
					# validate id
					if (isset($this->libraries[$project->id])) throw new \Exception($project->id . ' already exists for "' . $project->name . '"!');
					# create object
					$this->libraryProjects[$project->id] = $project;
					break;
				case Sources\Project::TYPE_IMPLEMENTATION_PROJECT:
					# create package
					if (!isset($this->projects[$project->getLastDependencyId()])) $this->projects[$project->getLastDependencyId()] = array();
					# validate id
					if (isset($this->projects[$project->getLastDependencyId()][$project->id])) throw new \Exception($project->id . ' already exists!');
					# create object
					$this->implementationProjects[$project->getLastDependencyId()][$project->id] = $project;
					# get applications
					foreach ($project->applications as $application) {
						# create package
						if (!isset($this->applications[$project->id])) $this->applications[$project->id] = array();
						# validate id
						if (isset($this->applications[$project->id][$application->id])) throw new \Exception($application->id . ' already exists!');
						# create object
						$this->applications[$project->id][$application->id] = $application;
					}
					break;
				default:
					throw new \Exception('Unknown type "' . $project->type . '"');
					break;
			}
		}
	}

	/**
	 * @param string $pathname
	 * @return Foomo\Zugspitze\Vendor\Sources\Project
	 */
	private function getProject($pathname)
	{
		$xml = $pathname . '/resources/configs/zugspitze-project.xml';
		if ((!\file_exists($xml))) throw new \Exception('Vendor  ' . $pathname . ' does not contain a /resources/configs/zugspitze-project.xml file!' . $xml);
		return Sources\Project::fromXML(simplexml_load_file($xml), $pathname);
	}
}