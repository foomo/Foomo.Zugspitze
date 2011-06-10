<?php

namespace Zugspitze\Scaffold\Frontend;

/**
 * 
 */
class Model
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Zugspitze\Scaffold
	 */
	public $scaffold;
	/**
	 * @var Zugspitze\Scaffold\Generator
	 */
	public $generator;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------
	
	public function __construct()
	{
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * initialize
	 *
	 * @param string $libraryId
	 * @param string $applicationId
	 * @param string $package
	 */
	public function scaffold($libraryId, $projectId, $applicationId, $package)
	{
		$this->scaffold = new \Zugspitze\Scaffold(\Zugspitze\Module::getVendorDir());
		$this->generator = $this->scaffold->getGenerator($libraryId, $projectId, $applicationId, $package);
		$this->generator->render();
		$this->generator->createPackage();
	}
}