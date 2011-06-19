<?php

namespace Foomo\Zugspitze\Services\Compiler;

/**
 * services in a module
 */
class ModuleInfo {
	/**
	 * name of the module
	 *
	 * @var string
	 */
	public $module;
	/**
	 * available services
	 *
	 * @var ZSCompilerServiceServiceInfo[]
	 */
	public $services = array();
}

