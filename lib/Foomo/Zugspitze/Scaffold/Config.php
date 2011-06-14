<?php

namespace Foomo\Zugspitze\Scaffold;

class Config
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------
	
	const TYPE_CORE_LIBRARY				= 'Core Library';
	const TYPE_IMPLEMENTATION_PROJECT	= 'Implementation Project';
	
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var string
	 */
	public $type;
	/**
	 * @var boolean
	 */
	public $exclude;
	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var string
	 */
	public $description;
	/**
	 * @var string[]
	 */
	public $dependencies;
	/**
	 * @var Foomo\Zugspitze\Scaffold\Config\Application[]
	 */
	public $applications;

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @return string
	 */
	public function getLastDependencyId()
	{
		return $this->dependencies[count($this->dependencies) - 1];
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 *
	 * @param string $pathname
	 * @param string $filename 
	 * @return Foomo\Zugspitze\Scaffold\Config
	 */
	public static function parseXML($filename)
	{
		if (!\file_exists($filename)) throw new \Exception($filename . ' does not exist!');
		$xml = \simplexml_load_file($filename);
		
		$config = new self;
		$config->id = (string) $xml->id;
		$config->type = (string) $xml->type;
		$config->exclude = (isset($xml->exclude) && $xml->exclude == 'true');
		$config->name = (string) $xml->name;
		$config->description = (string) $xml->description;
		$config->dependencies = array();
		$config->applications = array();
		

		# parse dependencies
		if (isset($xml->dependencies->id)) {
			if (\count($xml->dependencies->id) > 1) {
				foreach ($xml->dependencies->id as $value) {
					$config->dependencies[] = (string) $value;
				}
			} else {
				$config->dependencies[] = (string) $xml->dependencies->id;
			}
		}
		
		# parse applicaitons
		if (isset($xml->applications->application)) {
			if (\count($xml->applications->application) > 1) {
				foreach ($xml->applications->application as $applicationXml) {
					$config->applications[] =  self::parseApplicationXml($applicationXml);
				}
			} else {
				$config->applications[] =  self::parseApplicationXml($xml->applications->application);
			}
		} 		
		
		return $config;
	}	
	
	
	/**
	 * @param object $xml 
	 * @return Foomo\Zugspitze\Scaffold\Config\Application
	 */
	private static function parseApplicationXml($xml)
	{
		$application = new \Foomo\Zugspitze\Scaffold\Config\Application();
		$application->id = (string) $xml->id;
		$application->name = (string) $xml->name;
		$application->description = (string) $xml->description;
		$application->package = (string) $xml->package;
		$application->exclude = (isset($xml->exclude) && $xml->exclude == 'true');
		$application->sources = array();
		$application->externals = array();

		# parse sources
		if (isset($xml->sources->path)) {
			if (\count($xml->sources->path) > 1) {
				foreach ($xml->sources->path as $value) {
					$application->sources[] = (string) $value;
				}
			} else {
				$application->sources[] = (string) $xml->sources->path;
			}
		}

		# parse externals
		if (isset($xml->externals->path)) {
			if (\count($xml->externals->path) > 1) {
				foreach ($xml->externals->path as $value) {
					$application->externals[] = (string) $value;
				}
			} else {
				$application->externals[] = (string) $xml->externals->path;
			}
		}

		return $application;
	}
}