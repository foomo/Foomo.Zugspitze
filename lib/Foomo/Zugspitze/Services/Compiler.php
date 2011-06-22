<?php

namespace Foomo\Zugspitze\Services;

/**
 * get infos about compileable services on this server
 */
class Compiler
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const VERSION = 0.1;

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * get services informations
	 *
	 * @return Foomo\Zugspitze\Services\Compiler\ModuleInfo[]
	 */
	public function getServices()
	{
		$services = \Foomo\Services\Utils::getAllLocalServiceDescriptions();
		$ret = array();
		foreach ($services as $module => $serviceDescriptions) {
			// check if there is relevant stuff in that module
			$zsServices = array();
			foreach ($serviceDescriptions as $serviceDescription) {
				/* @var $serviceDescription Foomo\Services\ServiceDescription */
				if ($serviceDescription->compilerAvailable) {
					$zsServices[] = Compiler\ServiceInfo::fromServiceDescription($serviceDescription, $module);
				}
			}
			if (count($zsServices)> 0) {
				$entry = new Compiler\ModuleInfo();
				$entry->module = $module;
				$entry->services = $zsServices;
				$ret[] = $entry;
			}
		}
		return $ret;
	}
}
