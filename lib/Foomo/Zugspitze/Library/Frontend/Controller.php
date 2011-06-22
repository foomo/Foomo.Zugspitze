<?php

namespace Foomo\Zugspitze\Library\Frontend;

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
	 * @var Foomo\Zugspitze\Library\Frontend\Model
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
		$this->model->presets = \Foomo\Zugspitze\Module::getLibraryConfig()->entries;
		$this->model->libraryProjects = \Foomo\Zugspitze\Vendor::getSources()->getLibraryProjects(false);
	}

	/**
	 * @param string[] $projectLibraryIds
	 */
	public function actionCompileLibrary($sdkId)
	{
		$projectLibraryIds = $_POST['projectLibraryIds'];
		if (is_null($projectLibraryIds) || empty($projectLibraryIds)) \Foomo\MVC::redirect ('default');
		$filename = \Foomo\Zugspitze\Library::compile($projectLibraryIds, $sdkId, $this->model->report);
		if (file_exists($filename)) {
			\Foomo\MVC::abort();
			\Foomo\Utils::streamFile($filename, 'Zugspitze.swc', 'application/actet-stream', true);
			exit;
		}
	}

	/**
	 * Generates the scaffolding model, creates and streams the output containing the complete component as tgz file
	 *
	 * @param string $libraryProjectId
	 * @param string $implementationProjectId
	 * @param string $implementationProjectApplicationId
	 * @param string $packageName
	public function actionGenerateApplication($libraryProjectId, $implementationProjectId, $implementationProjectApplicationId, $packageName)
	{
		\Foomo\MVC::abort();
		$generator = \Foomo\Zugspitze\Scaffold::getApplicationGenerator($libraryProjectId, $implementationProjectId, $implementationProjectApplicationId, $packageName);
		$generator->render();
		$generator->createPackage();
		$generator->streamPackage();
		exit();
	}
	 */
}
