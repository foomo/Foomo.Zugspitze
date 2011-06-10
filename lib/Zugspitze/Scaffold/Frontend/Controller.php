<?php

namespace Zugspitze\Scaffold\Frontend;

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
	 * @var Zugspitze\Scaffold\Frontend\Model
	 */
	public $model;
	
	//---------------------------------------------------------------------------------------------
	// ~ Action methods
	//---------------------------------------------------------------------------------------------

	/**
	 * this method is executed by default
	 */
	public function actionDefault()
	{
	}

	/**
	 * generates the scaffolding model, creates and streams the output containing the complete component as tgz file
	 */
	public function actionGenerate($libraryId, $projectId, $applicationId, $package)
	{
		\Foomo\MVC::abort();
		$this->model->scaffold($libraryId, $projectId, $applicationId, $package);
		$this->model->generator->streamPackage();
		exit();
	}
}
