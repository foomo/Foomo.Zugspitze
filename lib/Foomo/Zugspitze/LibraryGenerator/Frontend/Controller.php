<?php

namespace Foomo\Zugspitze\LibraryGenerator\Frontend;

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
	 * @var Foomo\Zugspitze\LibraryGenerator\Frontend\Model
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
		$this->model->presets = \Foomo\Zugspitze\Module::getLibraryGeneratorConfig()->entries;
		$this->model->libraryProjects = \Foomo\Zugspitze\Vendor::getSources()->getLibraryProjectsByType(\Foomo\Zugspitze\Vendor\Sources\Project::TYPE_LIBRARY_PROJECT, false);
		$this->model->coreLibraryProjects = \Foomo\Zugspitze\Vendor::getSources()->getLibraryProjectsByType(\Foomo\Zugspitze\Vendor\Sources\Project::TYPE_CORE_LIBRARY_PROJECT, false);
	}

	/**
	 * @param string[] $projectLibraryIds
	 */
	public function actionCompileLibrary($sdkId)
	{
		$projectLibraryIds = $_POST['projectLibraryIds'];
		if (is_null($projectLibraryIds) || empty($projectLibraryIds)) \Foomo\MVC::redirect ('default');
		$filename = \Foomo\Zugspitze\LibraryGenerator::compile($projectLibraryIds, $sdkId, $this->model->report);
		if (file_exists($filename)) {
			\Foomo\MVC::abort();
			\Foomo\Utils::streamFile($filename, 'Zugspitze.swc', 'application/octet-stream', true);
			exit;
		}
	}
}
