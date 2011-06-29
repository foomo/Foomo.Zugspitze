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
class Library
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var string[]
	 */
	public $sources = array();
	/**
	 * @var string[]
	 */
	public $externals = array();
	/**
	 * @var string
	 */
	public $pathname;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param string $pathname
	 */
	public function __construct($id, $pathname)
	{
		$this->id = $id;
		$this->pathname = $pathname;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $soure
	 */
	public function addSource($source)
	{
		$this->sources[] = $source;
	}

	/**
	 * @param string $dependency
	 */
	public function addExternal($external)
	{
		$this->externals[] = $external;
	}

	/**
	 * @param bool $absolute
	 * @return string[]
	 */
	public function getSources($absolute=true)
	{
		return ($absolute) ? $this->getAbsolutePaths($this->sources) : $this->sources;
	}

	/**
	 * @param bool $absolute
	 * @return string[]
	 */
	public function getExternals($absolute=true)
	{
		return ($absolute) ? $this->getAbsolutePaths($this->externals) : $this->externals;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string[] $paths
	 * @return string[]
	 */
	private function getAbsolutePaths($paths)
	{
		$absPath = array();
		foreach ($paths as $path) {
			if (substr($path, 0, 1) != DIRECTORY_SEPARATOR) {
				$absPath[] = $this->pathname . DIRECTORY_SEPARATOR . $path;
			} else {
				$absPath[] = $path;
			}
		}
		return $absPath;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $id
	 * @param SimpleXMLElement $xml
	 * @param string $pathname
	 * @return Foomo\Zugspitze\Vendor\Sources\Library
	 */
	public static function fromXML($id, \SimpleXMLElement $xml, $pathname)
	{
		$project = new self(
				$id,
				$pathname
		);

		# parse sources
		if (isset($xml->sources->path)) {
			if (\count($xml->sources->path) > 1) {
				foreach ($xml->sources->path as $value) {
					$project->addSource((string) $value);
				}
			} else {
				$project->addSource((string) $xml->sources->path);
			}
		}

		# parse externals
		if (isset($xml->externals->path)) {
			if (\count($xml->externals->path) > 1) {
				foreach ($xml->externals->path as $value) {
					$project->addExternal((string) $value);
				}
			} else {
				$project->addExternal((string) $xml->externals->path);
			}
		}

		return $project;
	}
}