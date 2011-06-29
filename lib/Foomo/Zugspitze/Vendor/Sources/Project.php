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

namespace Foomo\Zugspitze\Vendor\Sources;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class Project
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const TYPE_LIBRARY_PROJECT			= 'Library Project';
	const TYPE_CORE_LIBRARY_PROJECT		= 'Core Library Project';
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
	public $dependencies = array();
	/**
	 * @var boolean
	 */
	public $exclude;
	/**
	 * @var string
	 */
	public $pathname;
	/**
	 *
	 * @var Foomo\Vendor\Sources\Application[]
	 */
	public $applications = array();

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $type
	 * @param string $name
	 * @param string $description
	 * @param array $dependencies
	 * @param boolean $exclude
	 * @param string $pathname
	 */
	public function __construct($id, $type, $name, $description, $exclude, $pathname)
	{
		$this->id = $id;
		$this->type = $type;
		$this->exclude = $exclude;
		$this->name = $name;
		$this->description = $description;
		$this->pathname = $pathname;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param Application $application
	 */
	public function addApplication(Application $application)
	{
		$this->applications[] = $application;
	}

	/**
	 * @param string $dependency
	 */
	public function addDependency($dependency)
	{
		$this->dependencies[] = $dependency;
	}

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
	 * @param SimpleXMLElement $xml
	 * @param string $pathname
	 * @return Foomo\Zugspitze\Vendor\Sources\Project
	 */
	public static function fromXML(\SimpleXMLElement $xml, $pathname)
	{
		$project = new self(
				(string) $xml->id,
				(string) $xml->type,
				(string) $xml->name,
				(string) $xml->description,
				(isset($xml->exclude) && $xml->exclude == 'true'),
				$pathname
		);

		# parse dependencies
		if (isset($xml->dependencies->id)) {
			if (\count($xml->dependencies->id) > 1) {
				foreach ($xml->dependencies->id as $value) {
					$project->addDependency((string) $value);
				}
			} else {
				$project->addDependency((string) $xml->dependencies->id);
			}
		}

		# parse applicaitons
		if (isset($xml->applications->application)) {
			if (\count($xml->applications->application) > 1) {
				foreach ($xml->applications->application as $applicationXml) {
					$project->addApplication(Application::fromXML($applicationXml, $pathname));
				}
			} else {
				$project->addApplication(Application::fromXML($xml->applications->application, $pathname));
			}
		}

		return $project;
	}
}