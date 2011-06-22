<?php

namespace Foomo\Zugspitze\ProxyUpdater\Frontend;

/**
 *
 */
class Controller
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\ProxyUpdater\Frontend\Model
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
	 * Renders an ant file and pumps it out
	 */
	public function actionGetAntBuildFile($configId)
	{
		$this->model->filename = \Foomo\Zugspitze\ProxyUpdater::generateAntBuildFile($configId);
		if ($this->model->filename) {
			\Foomo\MVC::abort();
			\Foomo\Zugspitze\ProxyUpdater::streamAntBuildFile($this->model->filename);
			exit;
		}
	}
}
