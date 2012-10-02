<?php

/*
 * This file is part of the foomo Opensource Framework.
 *
 * The foomo Opensource Framework is free software: you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General Public License as
 * published  by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * The foomo Opensource Framework is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along with
 * the foomo Opensource Framework. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Foomo\Zugspitze\ProxyGenerator\Frontend;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
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
	 *
	 */
	public function actionReport()
	{
	}

	/**
	 * @param string $serviceUrl
	 */
	public function actionGenerateASClient($serviceUrl)
	{
		//$this->generateASClientSrc(\Foomo\Services\Utils::getServiceDescription($serviceUrl));
		$this->compressASClientSrc(\Foomo\Services\Utils::getServiceDescription($serviceUrl));
	}

	/**
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
	 * @param string $serviceUrl
	 * @param string $configId
	 */
	public function actionGetASClientAsSwc($serviceUrl, $configId)
	{
		$this->compileASClientSrc(\Foomo\Services\Utils::getServiceDescription($serviceUrl), $configId);
		if ($this->model->report->success) $this->streamSwc();
	}

	/**
	 * Renders an ant file and pumps it out
	 */
	public function actionGetAntBuildFile($configId)
	{
		$filename = \Foomo\Zugspitze\ProxyUpdater::generateAntBuildFile($configId);
		if ($filename) {
			\Foomo\MVC::abort();
			\Foomo\Zugspitze\ProxyUpdater::streamAntBuildFile($filename);
			exit;
		}
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
			new \Foomo\Zugspitze\ProxyGenerator\RPC($description)
		);
	}

	/**
	 * @param Foomo\Services\ServiceDescription $description
	 */
	private function compressASClientSrc($description)
	{
		$this->model->report = \Foomo\Services\ProxyGenerator\ActionScript::packSrc(
			$description->name,
			new \Foomo\Zugspitze\ProxyGenerator\RPC($description)
		);
	}

	/**
	 * @param string $configId
	 */
	private function compileASClientSrc($description, $configId)
	{
		$this->model->report = \Foomo\Services\ProxyGenerator\ActionScript::compileSrc(
			$description->name,
			new \Foomo\Zugspitze\ProxyGenerator\RPC($description),
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