<?php

namespace Foomo\Zugspitze\Scaffold\Frontend;

/**
 *
 */
class Controller
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * model
	 *
	 * @var Foomo\Zugspitze\Scaffold\Frontend\Model
	 */
	public $model;

	//---------------------------------------------------------------------------------------------
	// ~ Action methods
	//---------------------------------------------------------------------------------------------

	/**
	 * This method is executed by default
	 */
	public function actionDefault()
	{
	}

	/**
	 * Generates the scaffolding model, creates and streams the output containing the complete component as tgz file
	 *
	 * @param string $libraryProjectId
	 * @param string $implementationProjectId
	 * @param string $implementationProjectApplicationId
	 * @param string $packageName
	 */
	public function actionGenerateApplication($libraryProjectId, $implementationProjectId, $implementationProjectApplicationId, $packageName)
	{
		\Foomo\MVC::abort();
		$generator = \Foomo\Zugspitze\Scaffold::getApplicationGenerator($libraryProjectId, $implementationProjectId, $implementationProjectApplicationId, $packageName);
		$generator->render();
		$generator->createPackage();
		$generator->streamPackage();
		exit();
	}
}
