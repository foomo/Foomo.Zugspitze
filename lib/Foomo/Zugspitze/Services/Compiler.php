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

namespace Foomo\Zugspitze\Services;

/**
 * get infos about compileable services on this server
 * 
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author jan <jan@bestbytes.de>
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