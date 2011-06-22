<?php

namespace Foomo\Zugspitze\Vendor\Sources;

class Project
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const TYPE_LIBRARY_PROJECT = 'Core Library';
	const TYPE_IMPLEMENTATION_PROJECT = 'Implementation Project';

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var string
	 */
	public $type;
	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var string
	 */
	public $description;
	/**
	 * @var string[]
	 */
	public $dependencies = array();
	/**
	 * @var boolean
	 */
	public $exclude;
	/**
	 * @var string
	 */
	public $pathname;
	/**
	 *
	 * @var Foomo\Vendor\Sources\Application[]
	 */
	public $applications = array();

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $type
	 * @param string $name
	 * @param string $description
	 * @param array $dependencies
	 * @param boolean $exclude
	 * @param string $pathname
	 */
	public function __construct($id, $type, $name, $description, $exclude, $pathname)
	{
		$this->id = $id;
		$this->type = $type;
		$this->exclude = $exclude;
		$this->name = $name;
		$this->description = $description;
		$this->pathname = $pathname;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param Application $application
	 */
	public function addApplication(Application $application)
	{
		$this->applications[] = $application;
	}

	/**
	 * @param string $dependency
	 */
	public function addDependency($dependency)
	{
		$this->dependencies[] = $dependency;
	}

	/**
	 * @return string
	 */
	public function getLastDependencyId()
	{
		return $this->dependencies[count($this->dependencies) - 1];
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param SimpleXMLElement $xml
	 * @param string $pathname
	 * @return Foomo\Zugspitze\Vendors\Project
	 */
	public static function fromXML(\SimpleXMLElement $xml, $pathname)
	{
		$project = new self(
				(string) $xml->id,
				(string) $xml->type,
				(string) $xml->name,
				(string) $xml->description,
				(isset($xml->exclude) && $xml->exclude == 'true'),
				$pathname
		);

		# parse dependencies
		if (isset($xml->dependencies->id)) {
			if (\count($xml->dependencies->id) > 1) {
				foreach ($xml->dependencies->id as $value) {
					$project->addDependency((string) $value);
				}
			} else {
				$project->addDependency((string) $xml->dependencies->id);
			}
		}

		# parse applicaitons
		if (isset($xml->applications->application)) {
			if (\count($xml->applications->application) > 1) {
				foreach ($xml->applications->application as $applicationXml) {
					$project->addApplication(Application::fromXML($applicationXml, $pathname));
				}
			} else {
				$project->addApplication(Application::fromXML($xml->applications->application, $pathname));
			}
		}

		return $project;
	}
}