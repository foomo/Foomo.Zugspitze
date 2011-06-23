<?php

namespace Foomo\Zugspitze\Vendor\Sources;

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