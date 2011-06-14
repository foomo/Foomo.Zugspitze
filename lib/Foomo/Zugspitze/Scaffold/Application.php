<?php

namespace Foomo\Zugspitze\Scaffold;

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
	public $sources;	
	/**
	 * @var string[]
	 */
	public $externals;	
	/**
	 * @var string
	 */
	public $pathname;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct($id, $name, $description, $package, $exclude, $sources, $externals, $pathname)
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->package = $package;
		$this->exclude = $exclude;
		$this->sources = $sources;
		$this->externals = $externals;
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
	
}