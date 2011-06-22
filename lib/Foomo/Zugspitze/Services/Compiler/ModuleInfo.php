<?php

namespace Foomo\Zugspitze\Services\Compiler;

/**
 * services in a module
 */
class ModuleInfo
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * name of the module
	 *
	 * @var string
	 */
	public $module;
	/**
	 * available services
	 *
	 * @var Foomo\Zugspitze\Services\Compiler\ServiceInfo[]
	 */
	public $services = array();
}

