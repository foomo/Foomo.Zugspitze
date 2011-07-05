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
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class Scaffold
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const VERSION = 0.1;

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Scaffolding
	 */
	private $sources;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		$this->sources = new \Foomo\Zugspitze\Scaffold(\Foomo\Zugspitze\Module::getVendorDir());
	}

	//---------------------------------------------------------------------------------------------
	// ~ Service methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return Foomo\Zugspitze\Services\Scaffold\Library[]
	 */
	public function getLibraries()
	{
		$result = array();
		foreach (\Foomo\Flash\Vendor::getSources()->getLibraryProjects() as $project) {
			/* @var  $library Foomo\Flash\Vendor\Sources\Project */
			$obj = new \Foomo\Zugspitze\Services\Scaffold\Library();
			$obj->id = $project->id;
			$obj->name = $project->name;
			$obj->group = $project->group;
			$obj->description = $project->description;
			$result[] = $obj;
		}
		return $result;
	}

	/**
	 * @param string $libraryProjectId
	 * @return Foomo\Zugspitze\Services\Scaffold\Project[]
	 */
	public function getProjects($libraryProjectId)
	{
		$result = array();
		foreach (\Foomo\Flash\Vendor::getSources()->getImplementationProjects($libraryProjectId) as $project) {
			/* @var $library Foomo\Flash\Vendor\Sources\Project */
			$obj = new \Foomo\Zugspitze\Services\Scaffold\Project();
			$obj->id = $project->id;
			$obj->name = $project->name;
			$obj->group = $project->group;
			$obj->description = $project->description;
			$result[] = $obj;
		}
		return $result;
	}

	/**
	 * @param string $implementationProjectId
	 * @return Foomo\Zugspitze\Services\Scaffold\Application[]
	 */
	public function getApplications($implementationProjectId)
	{
		$result = array();
		foreach (\Foomo\Flash\Vendor::getSources()->getImplementationProjectApplications($implementationProjectId) as $application) {
			/* @var  $library Foomo\Flash\Vendor\Sources\Application */
			$obj = new \Foomo\Zugspitze\Services\Scaffold\Application();
			$obj->id = $application->id;
			$obj->name = $application->name;
			$obj->description = $application->description;
			$result[] = $obj;
		}
		return $result;
	}
}