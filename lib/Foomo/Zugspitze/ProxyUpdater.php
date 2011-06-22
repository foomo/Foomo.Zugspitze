<?php

namespace Foomo\Zugspitze;

class ProxyUpdater
{
	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return string Filename
	 */
	public static function generateAntBuildFile($configId)
	{
		$sdk = \Foomo\Flex\DomainConfig::getInstance()->getEntry($configId);
		$view = Module::getView('Foomo\\Zugspitze\\ProxyUpdater', 'ProxyUpdater/AntBuildFile', $sdk);
		$fileName = tempnam(Module::getTmpDir(), 'proxyUpdater-');
		file_put_contents($fileName, $view->render());
		return $fileName;
	}

	/**
	 * host => Foomo\Services\ServiceDescription[]
	 *
	 * @return array
	 */
	public static function getServices()
	{
		return array($_SERVER['HTTP_HOST'] => \Foomo\Services\Utils::getAllLocalServiceDescriptions());
		//return array_merge(array($_SERVER['HTTP_HOST'] => \Foomo\Services\Utils::getAllLocalServiceDescriptions()), \Foomo\Services\Utils::getAllRemoteServiceDescriptions());
	}

	/**
	 * get the name of the ant file
	 *
	 * @return string
	 */
	public static function getAntBuildFileName()
	{
		return $_SERVER['HTTP_HOST'] .'-ProxyUpdater.xml';
	}

	/**
	 * @param string $filename Path to buildfile.xml
	 */
	public static function streamAntBuildFile($filename)
	{
		\Foomo\Utils::streamFile($filename, \Foomo\Zugspitze\ProxyUpdater::getAntBuildFileName(), 'text/xml', true);
	}

}