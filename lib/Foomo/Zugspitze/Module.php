<?php

namespace Foomo\Zugspitze;

/**
 * zugspitze module
 */
class Module extends \Foomo\Modules\ModuleBase implements \Foomo\Frontend\ToolboxInterface
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const NAME = 'Foomo.Zugspitze';

	//---------------------------------------------------------------------------------------------
	// ~ Overriden methods
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
			\Foomo\Modules\Resource\Module::getResource('Foomo', self::VERSION),
			\Foomo\Modules\Resource\Module::getResource('Foomo.Flash', self::VERSION),
			\Foomo\Modules\Resource\Module::getResource('Foomo.Services', self::VERSION),
			\Foomo\Modules\Resource\Config::getResource(self::NAME, 'Foomo.Zugspitze.libraryGeneratorConfig'),
			\Foomo\Modules\Resource\Fs::getVarResource(\Foomo\Modules\Resource\Fs::TYPE_FOLDER, 'tmp' . DIRECTORY_SEPARATOR . self::NAME),
			\Foomo\Modules\Resource\Fs::getVarResource(\Foomo\Modules\Resource\Fs::TYPE_FOLDER, 'modules' . DIRECTORY_SEPARATOR . self::NAME)
		);
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return string
	 */
	public static function getVendorDir()
	{
		return self::getBaseDir('vendor');
	}

	/**
	 * @todo rename config
	 * @return Foomo\Zugspitze\LibraryGenerator\Config
	 */
	public static function getLibraryGeneratorConfig()
	{
		return \Foomo\Config::getConf(self::NAME, LibraryGenerator\Config::NAME);
	}

	//---------------------------------------------------------------------------------------------
	// ~ Toolbox interface methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @internal
	 * @return array
	 */
	public static function getMenu()
	{
		return array(
			\Foomo\Frontend\ToolboxConfig\MenuEntry::create('Root.Modules.Zugspitze.ApplicationGenerator', 'Application Generator', self::NAME, 'Foomo\\Zugspitze\\Scaffold\\Frontend'),
			\Foomo\Frontend\ToolboxConfig\MenuEntry::create('Root.Modules.Zugspitze.LibraryGenerator', 'Library Generator', self::NAME, 'Foomo\\Zugspitze\\LibraryGenerator\\Frontend'),
			\Foomo\Frontend\ToolboxConfig\MenuEntry::create('Root.Modules.Zugspitze.ProxynGenerator', 'Proxy Generator', self::NAME, 'Foomo\\Zugspitze\\ProxyGenerator\\Frontend'),
			\Foomo\Frontend\ToolboxConfig\MenuEntry::create('Root.Modules.Zugspitze.ProxyUpdater', 'Proxy Updater', self::NAME, 'Foomo\\Zugspitze\\ProxyUpdater\\Frontend'),
		);
	}
}
