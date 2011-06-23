<?php

namespace Foomo\Zugspitze;

/**
 * zugspitze module
 */
class Module extends \Foomo\Modules\ModuleBase
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const NAME = 'Foomo.Zugspitze';

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * initialize you module here may add some auto loading, will also be called, when switching between modes with Foomo\Config::setMode($newMode)
	 */
	public static function initializeModule()
	{
	}

	/**
	 * describe your module - text only
	 *
	 * @return string
	 */
	public static function getDescription()
	{
		return 'zugspitze client framework integration i.e. scaffoldgenarators, service proxy ant builds, ...';
	}

	/**
	 * get all the module resources
	 *
	 * @return Foomo\Modules\Resource[]
	 */
	public static function getResources()
	{
		return array(
			\Foomo\Modules\Resource\Module::getResource('Foomo.Services', self::VERSION),
			\Foomo\Modules\Resource\Config::getResource(self::NAME, LibraryGenerator\DomainConfig::NAME),
			\Foomo\Modules\Resource\Fs::getVarResource(\Foomo\Modules\Resource\Fs::TYPE_FOLDER, 'tmp' . DIRECTORY_SEPARATOR . self::NAME),
			\Foomo\Modules\Resource\Fs::getVarResource(\Foomo\Modules\Resource\Fs::TYPE_FOLDER, 'modules' . DIRECTORY_SEPARATOR . self::NAME)
		);
	}

	/**
	 * @return string
	 */
	public static function getBaseDir()
	{
		return \Foomo\CORE_CONFIG_DIR_MODULES . DIRECTORY_SEPARATOR . self::NAME;
	}

	/**
	 * @return string
	 */
	public static function getVendorDir()
	{
		return self::getBaseDir() . DIRECTORY_SEPARATOR . 'vendor';
	}

	/**
	 * @return string
	 */
	public static function getTmpDir()
	{
		$filename = 'tmp' . DIRECTORY_SEPARATOR . self::NAME;
		self::validateResourceDir($filename);
		return \Foomo\Config::getVarDir() . DIRECTORY_SEPARATOR . $filename;
	}

	/**
	 * @return string
	 */
	public static function getLogDir()
	{
		return \Foomo\Config::getLogDir(self::NAME);
	}

	/**
	 * @return string
	 */
	public static function getVarDir()
	{
		$filename = 'modules' . DIRECTORY_SEPARATOR . self::NAME;
		self::validateResourceDir($filename);
		return \Foomo\Config::getVarDir() . DIRECTORY_SEPARATOR . $filename;
	}

	/**
	 * @param string $filename
	 */
	public static function validateResourceDir($filename)
	{
		$resource = \Foomo\Modules\Resource\Fs::getVarResource(\Foomo\Modules\Resource\Fs::TYPE_FOLDER, $filename);
		if (!$resource->resourceValid()) $resource->tryCreate();
		if (!\file_exists(\Foomo\Config::getVarDir() . DIRECTORY_SEPARATOR . $filename)) throw new \Exception('Resource ' . $filename . ' does not exits');
	}

	/**
	 *
	 * @return Foomo\Zugspitze\LibraryGenerator\DomainConfig
	 */
	public static function getLibraryGeneratorConfig()
	{
		return \Foomo\Config::getConf(self::NAME, LibraryGenerator\DomainConfig::NAME);
	}

	/**
	 *
	 * @return Foomo\Flex\DomainConfig
	 */
	public static function getFlexConfig()
	{
		return \Foomo\Config::getConf(\Foomo\Flash\Module::NAME, \Foomo\Flex\DomainConfig::NAME);
	}
}