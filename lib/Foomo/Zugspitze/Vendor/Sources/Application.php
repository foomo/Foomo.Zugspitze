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
class Application
{
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
	public $name;
	/**
	 * @var string
	 */
	public $description;
	/**
	 * @var string
	 */
	public $package;
	/**
	 * @var boolean
	 */
	public $exclude;
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
	 * @param string $name
	 * @param string $description
	 * @param string $package
	 * @param bool $exclude
	 * @param string $pathname
	 */
	public function __construct($id, $name, $description, $package, $exclude, $pathname)
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->package = $package;
		$this->exclude = $exclude;
		$this->pathname = $pathname;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return string[]
	 */
	public function getFiles()
	{
		$files = array();
		foreach ($this->sources as $source) {
			if (\is_dir($this->pathname . '/' . $source)) {
				$files = \array_merge($files, $this->dirTreeFiles($source));
			} else {
				$files[] = $source;
			}
		}
		return $files;
	}

	/**
	 * @param string $source
	 */
	public function addSource($source)
	{
		$this->sources[] = $source;
	}

	/**
	 * @param string $external
	 */
	public function addExternal($external)
	{
		$this->externals[] = $external;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $dir
	 * @return string[]
	 */
	private function dirTreeFiles($dir)
	{
		$path = '';
		$stack[] = $dir;
		while ($stack) {
			$thisdir = \array_pop($stack);
			if ($dircont = \scandir($this->pathname . '/' . $thisdir)) {
				$i = 0;
				while (isset($dircont[$i])) {
					if (!\in_array($dircont[$i], array('.', '..', '.svn', '.git'))) {
						$current_file = "{$thisdir}/{$dircont[$i]}";
						if (\is_file($this->pathname . '/' . $current_file)) {
							$path[] = "{$thisdir}/{$dircont[$i]}";
						} elseif (\is_dir($this->pathname . '/' . $current_file)) {
							#$path[] = "{$thisdir}/{$dircont[$i]}";
							$stack[] = $current_file;
						}
					}
					$i++;
				}
			}
		}
		return $path;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param SimpleXMLElement $xml
	 * @param string $pathname
	 * @return Foomo\Zugspitze\Scaffold\Config\Application
	 */
	public static function fromXML(\SimpleXMLElement $xml, $pathname)
	{
		$application = new self(
				(string) $xml->id,
				(string) $xml->name,
				(string) $xml->description,
				(string) $xml->package,
				(isset($xml->exclude) && $xml->exclude == 'true'),
				$pathname
		);

		# parse sources
		if (isset($xml->sources->path)) {
			if (\count($xml->sources->path) > 1) {
				foreach ($xml->sources->path as $value) {
					$application->addSource((string) $value);
				}
			} else {
				$application->addSource((string) $xml->sources->path);
			}
		}

		# parse externals
		if (isset($xml->externals->path)) {
			if (\count($xml->externals->path) > 1) {
				foreach ($xml->externals->path as $value) {
					$application->addExternal((string) $value);
				}
			} else {
				$application->addExternal((string) $xml->externals->path);
			}
		}

		return $application;
	}
}