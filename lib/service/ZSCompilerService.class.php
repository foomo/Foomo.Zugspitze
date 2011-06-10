<?php
/**
 * get infos about compileable services on this server
 */
class ZSCompilerService {
	const VERSION = 0.1;
	/**
	 * get services informations
	 * 
	 * @return ZSCompilerServiceModuleInfo[]
	 */
	public function getServices()
	{
		$services = \Foomo\Services\Utils::getAllLocalServiceDescriptions();
		$ret = array();
		foreach($services as $module => $serviceDescriptions) {
			// check if there is relevant stuff in that module
			$zsServices = array();
			foreach($serviceDescriptions as $serviceDescription) {
				/* @var $serviceDescription ServiceDescription */
				if($serviceDescription->compilerAvailable) {
					$zsServices[] = ZSCompilerServiceServiceInfo::fromServiceDescription($serviceDescription, $module);
				}
			}
			if(count($zsServices)> 0) {
				$entry = new ZSCompilerServiceModuleInfo();
				$entry->module = $module;
				$entry->services = $zsServices;
				$ret[] = $entry;
			}
		}
		return $ret;
	}
}
