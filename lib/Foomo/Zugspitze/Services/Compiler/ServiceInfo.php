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

namespace Foomo\Zugspitze\Services\Compiler;

use Foomo\Services\ServiceDescription;

/**
 * a service info
 *
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author jan <jan@bestbytes.de>
 */
class ServiceInfo
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	/**
	 * a rpc service using JSON for transports
	 */
	const TYPE_RPC_JSON = 'serviceTypeRpcJson';
	/**
	 * a rpc service using AMF for transports
	 */
	const TYPE_RPC_AMF = 'serviceTypeRpcAmf';
	/**
	 * a soap service
	 */
	const TYPE_SOAP = 'serviceTypeSoap';

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * uri, where to find a html documentation
	 *
	 * @var string
	 */
	public $documentationUrl;
	/**
	 * again an uri
	 *
	 * @var string
	 */
	public $recompileUrl;
	/**
	 * service url
	 *
	 * @var string
	 */
	public $url;
	/**
	 * basically the name of the class that was exposed as a service
	 *
	 * @var string
	 */
	public $name;
	/**
	 * typically the AS package i.e. a java like package notation com.foo.bar. ...
	 *
	 * @var string
	 */
	public $asPackage;
	/**
	 * as what kind of service was it exposed
	 *
	 * @var string
	 */
	public $type;
	/**
	 * version of the server and the generated client
	 *
	 * @var float
	 */
	public $version = 0.0;
	/**
	 * does the client use remote classes
	 *
	 * @var boolean
	 */
	public $usesRemoteClasses = false;
	/**
	 * name of the module the service belogns to
	 *
	 * @var string
	 */
	public $module;

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param ServiceDescription $serviceDescription
	 * @param string $module
	 * @return Foomo\Zugspitze\Services\Compiler\ServiceInfo
	 */
	public static function fromServiceDescription(ServiceDescription $serviceDescription, $module)
	{
		$ret = new self;
		$ret->module = $module;
		foreach($ret as $k => $v) {
			switch($k) {
				case 'url':
				case 'documentationUrl':
					$ret->$k = \Foomo\Utils::getServerUrl() . $serviceDescription->$k;
					break;
				case 'asPackage':
					$ret->asPackage = $serviceDescription->package;
					break;
				default:
					if(isset($serviceDescription->$k)) {
						$ret->$k = $serviceDescription->$k;
					}
			}
		}
		return $ret;
	}
}