<?php

namespace Foomo\Zugspitze;

class Scaffold
{
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 *
	 */
	public function __construct()
	{
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $projectLibraryId
	 * @param string $implementationProjectId
	 * @param string $implementationProjectApplicationId
	 * @param string $packageName
	 * @return Foomo\Zugspitze\Scaffold\ApplicationGenerator
	 */
	public static function getApplicationGenerator($libraryProjectId, $implementationProjectId, $implementationProjectApplicationId, $packageName)
	{
		$sources = Vendor::getSources();
		$libraryProject = $sources->getLibraryProject($libraryProjectId);
		$implementationProject = $sources->getImplementationProject($libraryProjectId, $implementationProjectId);
		$implementationProjectApplication = $sources->getImplementationProjectApplication($implementationProjectId, $implementationProjectApplicationId);
		return new \Foomo\Zugspitze\Scaffold\ApplicationGenerator($libraryProject, $implementationProject, $implementationProjectApplication, $packageName);
	}
}