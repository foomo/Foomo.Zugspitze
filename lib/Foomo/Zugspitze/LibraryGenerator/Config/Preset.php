<?php

namespace Foomo\Zugspitze\LibraryGenerator\Config;

class Preset
{
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $id;
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
	public $projectLibraryIds = array();

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $name
	 * @param string $description
	 * @param array $projectLibraryIds
	 */
	public function __construct($id, $name, $description, array $projectLibraryIds=array())
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->projectLibraryIds = $projectLibraryIds;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $name
	 * @param string $description
	 * @param array $projectLibraryIds
	 * @return Foomo\Zugspitze\LibraryGenerator\Config\Preset
	 */
	public static function create($id, $name, $description, array $projectLibraryIds=array())
	{
		return new self($id, $name, $description, $projectLibraryIds);
	}
}