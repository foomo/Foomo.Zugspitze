<?php

namespace Foomo\Zugspitze\ProxyGenerator\Frontend;

/**
 * @todo: only allow compilation on dev or test env
 */
class Controller
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\ProxyGenerator\Frontend\Model
	 */
	public $model;

	//---------------------------------------------------------------------------------------------
	// ~ Action methods
	//---------------------------------------------------------------------------------------------

	/**
	 *
	 */
	public function actionDefault()
	{
	}

	/**
	 * @param string $serviceUrl
	 */
	public function actionGenerateASClient($serviceUrl)
	{
		$this->generateASClientSrc(\Foomo\Services\Utils::getServiceDescription($serviceUrl));
	}

	/**
	 *
	 * @param string $serviceUrl
	 */
	public function actionGetASClientAsTgz($serviceUrl)
	{
		$this->compressASClientSrc(\Foomo\Services\Utils::getServiceDescription($serviceUrl));
		if ($this->model->report->success) $this->streamTgz();
	}

	/**
	 * @param string $serviceUrl
	 * @param string $configId
	 */
	public function actionCompileASClient($serviceUrl, $configId)
	{
		$this->compileASClientSrc(\Foomo\Services\Utils::getServiceDescription($serviceUrl), $configId);
	}

	/**
	 *
	 * @param string $serviceUrl
	 * @param string $configId
	 */
	public function actionGetASClientAsSwc($serviceUrl, $configId)
	{
		$this->compileASClientSrc(\Foomo\Services\Utils::getServiceDescription($serviceUrl), $configId);
		if ($this->model->report->success) $this->streamSwc();
	}

	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param Foomo\Services\ServiceDescription $description
	 */
	private function generateASClientSrc($description)
	{
		$this->model->report = \Foomo\Services\ProxyGenerator\ActionScript::generateSrc(
			$description->name,
			new \Foomo\Zugspitze\ProxyGenerator\RPC($description->package)
		);
	}

	/**
	 * @param Foomo\Services\ServiceDescription $description
	 */
	private function compressASClientSrc($description)
	{
		$this->model->report = \Foomo\Services\ProxyGenerator\ActionScript::packSrc(
			$description->name,
			new \Foomo\Zugspitze\ProxyGenerator\RPC($description->package)
		);
	}

	/**
	 * @param string $configId
	 */
	private function compileASClientSrc($description, $configId)
	{
		$this->model->report = \Foomo\Services\ProxyGenerator\ActionScript::compileSrc(
			$description->name,
			new \Foomo\Zugspitze\ProxyGenerator\RPC($description->package),
			$configId
		);
	}

	/**
	 *
	 */
	private function streamSwc()
	{
		\Foomo\MVC::abort();
		$filename = $this->model->report->generator->getSWCFilename();
		\Foomo\Utils::streamFile($filename, basename($filename), 'application/octet-stream', true);
		exit;
	}

	/**
	 *
	 */
	private function streamTgz()
	{
		\Foomo\MVC::abort();
		$filename = $this->model->report->generator->getTGZFilename();
		\Foomo\Utils::streamFile($filename, basename($filename), 'application/x-compressed', true);
		exit;
	}
}