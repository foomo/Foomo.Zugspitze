<?php

namespace Foomo\Zugspitze\Scaffold;

class Project
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var boolean
	 */
	public $exclude;
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
	public $dependencies;
	/**
	 * @var string
	 */
	public $pathname;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $name
	 * @param string $description
	 * @param array $dependencies
	 * @param boolean $exclude
	 * @param string $pathname 
	 */
	public function __construct($id, $name, $description, $dependencies, $exclude, $pathname)
	{
		$this->id = $id;
		$this->exclude = $exclude;
		$this->name = $name;
		$this->description = $description;
		$this->dependencies = $dependencies;
		$this->pathname = $pathname;
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @return string
	 */
	public function getLastDependencyId()
	{
		return $this->dependencies[count($this->dependencies) - 1];
	}
}