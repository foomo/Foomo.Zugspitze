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

namespace Foomo\Zugspitze\LibraryGenerator\Config;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class Preset
{
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $id;
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
	public $projectLibraryIds = array();

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $name
	 * @param string $description
	 * @param array $projectLibraryIds
	 */
	public function __construct($id, $name, $description, array $projectLibraryIds=array())
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->projectLibraryIds = $projectLibraryIds;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $name
	 * @param string $description
	 * @param array $projectLibraryIds
	 * @return Foomo\Zugspitze\LibraryGenerator\Config\Preset
	 */
	public static function create($id, $name, $description, array $projectLibraryIds=array())
	{
		return new self($id, $name, $description, $projectLibraryIds);
	}
}