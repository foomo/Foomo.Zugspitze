<?php

namespace Foomo\Zugspitze\Services\Compiler;

use Foomo\Services\ServiceDescription;
/**
 * a service info
 */
class ServiceInfo {
	/**
	 * a rpc service at this point using AMF for transports
	 *
	 */
	const TYPE_RPC = 'serviceTypeRPC';
	/**
	 * a soap service
	 *
	 */
	const TYPE_SOAP = 'serviceTypeSoap';
	/**
	 * the uri on the host the service is running on - it can possibly contain ampersands, so do not forget to escape them, when you use them in a markup context
	 *
	 * @var string
	 */
	public $downloadUrl;
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
	 * compile and download - all at once
	 *
	 * @var string
	 */
	public $compileAndDownloadUrl;
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
	public static function fromServiceDescription(ServiceDescription $serviceDescription, $module)
	{
		$ret = new self;
		$ret->module = $module;
		foreach($ret as $k => $v) {
			switch($k) {
				case 'downloadUrl':
//				case 'recompileUrl':
				case 'documentationUrl':
				case 'compileAndDownloadUrl':
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