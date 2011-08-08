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
 */
class Model
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Services\ProxyGenerator\ActionScript\Report
	 */
	public $report;
	/**
	 * @var array
	 */
	public $services = array();

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		foreach(\Foomo\Services\Utils::getAllServices() as $moduleName => $serviceUrls) {
			$moduleServices = array();
			foreach ($serviceUrls as $url) {
				$description = \Foomo\Services\Utils::getServiceDescription(\Foomo\Utils::getServerUrl(null, true) . $url);
				if (is_null($description)) continue;
				if ($description->type != \Foomo\Services\ServiceDescription::TYPE_RPC_AMF) continue;
				$moduleServices[] = $description;
			}
			if (empty($moduleServices)) continue;
			$this->services[$moduleName] = $moduleServices;
		}
	}
}