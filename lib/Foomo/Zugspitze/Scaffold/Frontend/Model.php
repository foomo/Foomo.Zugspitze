<?php

namespace Foomo\Zugspitze\Scaffold\Frontend;

/**
 * 
 */
class Model
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Scaffold
	 */
	public $scaffold;
	/**
	 * @var Foomo\Zugspitze\Scaffold\Generator
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
		$this->scaffold = new \Foomo\Zugspitze\Scaffold(\Foomo\Zugspitze\Module::getVendorDir());
		$this->generator = $this->scaffold->getGenerator($libraryId, $projectId, $applicationId, $package);
		$this->generator->render();
		$this->generator->createPackage();
	}
}