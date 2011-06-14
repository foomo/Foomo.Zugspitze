<?php

namespace Foomo\Zugspitze\Frontend;

/**
 * controller
 */
class Controller
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * model
	 *
	 * @var Foomo\Zugspitze\Module\Frontend\Model
	 */
	public $model;
	
	//---------------------------------------------------------------------------------------------
	// ~ Action methods
	//---------------------------------------------------------------------------------------------

	public function actionDefault()
	{
	}

	public function actionServices()
	{
	}

	public function actionCreationBuddy()
	{
	}

	public function actionGetCreationBuddy()
	{
		\Foomo\MVC::abort();
		\Foomo\Utils::streamFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CreationBuddy.air', 'CreationBuddy.air', 'application/vnd.adobe.air-application-installer-package+zip', true);
		exit;
	}

	/**
	 * renders an ant file and pumps it out
	 */
	public function actionGetAntFile()
	{
		\Foomo\MVC::abort();
		$antModel = new ZSServiceProxyUpdaterModel();
		$fileContents = $antModel->getAntFileContents();
		$tempFileName = tempnam(sys_get_temp_dir(), __CLASS__);
		file_put_contents($tempFileName, $fileContents);
		\Foomo\Utils::streamFile($tempFileName, ZSServiceProxyUpdaterModel::getAntFileName(), 'text/xml', true);
		unlink($tempFileName);
		exit;
	}
}