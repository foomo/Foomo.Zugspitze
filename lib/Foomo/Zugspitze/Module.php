<?php

namespace Foomo\Zugspitze;

use Foomo\Modules\ModuleBase;

/**
 * zugspitze module
 */
class Module extends ModuleBase
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
		if (!isset(\Foomo\Flex\Settings::$PROJECT_DIR)) {
			\Foomo\Flex\Settings::$PROJECT_DIR = \Foomo\Config::getTempDir() . DIRECTORY_SEPARATOR . 'flexClient';
		}
		if (!is_dir(\Foomo\Flex\Settings::$PROJECT_DIR)) {
			mkdir(\Foomo\Flex\Settings::$PROJECT_DIR);
		}
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
}