<?php

namespace Zugspitze\Scaffold;

class Generator
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const TYPE_AS_CLASS		= 'ASClass';
	const TYPE_AS_INCLUDE	= 'ASInclude';
	const TYPE_MXML			= 'mxml';
	const UMASK_DIR			= 0776;
	const UMASK_FILE		= 0666;

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	
	
	/**
	 * @var Zugspitze\Scaffold\Library
	 */
	private $library;
	/**
	 * @var Zugspitze\Scaffold\Project
	 */
	private $project;
	/**
	 * @var Zugspitze\Scaffold\Application
	 */
	private $application;

	/**
	 * @var string
	 */
	private $baseDir;
	/**
	 * @var string
	 */
	private $workingDir;
	
	/**
	 * @var string
	 */
	public $package;
	
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------
	
	public function __construct($library, $project, $application, $package)
	{
		# set values
		$this->library = $library;
		$this->project = $project;
		$this->application = $application;
		
		$this->package = $package;
		
		$this->baseDir = \Zugspitze\Module::getTmpDir(__CLASS__);
		$this->workingDir = $this->baseDir . DIRECTORY_SEPARATOR . $this->getWorkingDirName();
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * 
	 */
	public function render()
	{
		# remove old files
		$this->rmdir($this->workingDir);
		
		// create base folders
		$this->mkdir($this->workingDir, self::UMASK_DIR);
		
		$fromFiles = $this->application->getFiles();
		$toFiles = $this->getToFiles($fromFiles, $this->application->package, $this->package);
		
		for ($i=0; $i<count($fromFiles); $i++) {
			$fromFile = $this->application->pathname . \DIRECTORY_SEPARATOR . $fromFiles[$i];
			$toFile = $this->workingDir . \DIRECTORY_SEPARATOR . $toFiles[$i];
			$toDir = $this->dirname($toFile);
			$this->mkdir($toDir, self::UMASK_DIR);
			$this->copy($fromFile, $toFile);
			
			$search = array(
				$this->getXMLNamespace($this->application->package),
				$this->getOpeningXMLTag($this->application->package),
				$this->getClosingXMLTag($this->application->package),
				$this->application->package
			);
			$replace = array(
				$this->getXMLNamespace($this->package),
				$this->getOpeningXMLTag($this->package),
				$this->getClosingXMLTag($this->package),
				$this->package
			);
			
			$this->replace($toFile, $search, $replace);
		}
	}
	
	/**
	 * creates the downloadable archive-file
	 */
	public function createPackage()
	{
		\shell_exec('cd ' . $this->baseDir . ' && tar -czf ' . $this->getArchiveFileName() . ' ' . $this->getWorkingDirName());
	}

	/**
	 * offers the download to the user
	 */
	public function streamPackage()
	{
		\Foomo\Utils::streamFile($this->baseDir . DIRECTORY_SEPARATOR . $this->getArchiveFileName(), $this->getArchiveFileName(), 'application/octet-stream', true);
	}

	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @return string
	 */
	private function getWorkingDirName()
	{
		return $this->library->id . '_' . $this->package;
	}	
	
	/**
	 * @return string
	 */
	private function getArchiveFileName()
	{
		return $this->getWorkingDirName() . '.tgz';
	}	
	
	/**
	 * @param string $fromFiles
	 * @param string $fromPackage
	 * @param string $toPackage
	 * @return string[]
	 */
	private function getToFiles($fromFiles, $fromPackage, $toPackage)
	{
		$toFiles = array();
		foreach ($fromFiles as $value) {
			$toFiles[] = \str_replace(\str_replace('.', DIRECTORY_SEPARATOR, $fromPackage), \str_replace('.', DIRECTORY_SEPARATOR, $toPackage), $value);
		}
		return $toFiles;
	}
	
	/**
	 * @param string $filename
	 * @return string
	 */
	private function dirname($filename)
	{
		$path = \explode(DIRECTORY_SEPARATOR, $filename);
		\array_pop($path);
		return implode(DIRECTORY_SEPARATOR, $path);
	}
	
	/**
	 * @param string $pathname
	 * @param string $umask
	 */
	private function mkdir($pathname, $umask)
	{
		if (\file_exists($pathname)) return;
		
		$path = '';
		$pathnames = \explode(DIRECTORY_SEPARATOR, $pathname);
		
		foreach ($pathnames as $value) {
			if ($value == '') continue;
			$path .= DIRECTORY_SEPARATOR . $value;
			if (\file_exists($path)) continue;
			if (!is_writable(\dirname($path))) throw new \Exception(\dirname($path) . ' is not writeable!');
			mkdir($path, $umask);
			if (!\file_exists($path)) throw new \Exception($path . ' could not be created!');
		}
	}
	
	/**
	 * @param string $pathname
	 */
	private function rmdir($pathname)
	{
		if (!\file_exists($pathname)) return;
		if (!is_writable($pathname)) throw new \Exception($pathname . ' is not writeable!');
		\shell_exec('rm -rf ' . $pathname);
		if (\file_exists($pathname))  throw new \Exception($pathname . ' could not be removed!');
	}
		
	/**
	 * @param string $source
	 * @param string $dest 
	 */
	private function copy($source, $dest)
	{
		\copy($source, $dest);
		if (!\file_exists($dest)) throw new \Exception('Could not copy ' . $source . ' to ' . $dest);
		
	}
	
	/**
	 * @param string $filename
	 * @param mixed $search
	 * @param mixed $replace
	 */
	private function replace($filename, $search, $replace)
	{
		if (is_file($filename) === true) {
			$file = \fopen($filename, 'r');
			$temp = \tempnam(\sys_get_temp_dir(), 'tmp');

			if (\is_resource($file) === true) {
				while (\feof($file) === false) {
					\file_put_contents($temp, str_replace($search, $replace, fgets($file)), FILE_APPEND);
				}
				\fclose($file);
			}
			\unlink($filename);
		}
		\rename($temp, $filename);
		\chmod($filename, self::UMASK_FILE);
	}
	
	/**
	 * @param string $package
	 * @return string
	 */
	private function getXMLNamespace($package)
	{
		$parts = \explode('.', $package);
		return 'xmlns:' . \array_pop($parts);
	}
	
	/**
	 * @param string $package
	 * @return string
	 */
	private function getOpeningXMLTag($package)
	{
		$parts = \explode('.', $package);
		return '<' . \array_pop($parts) . ':';
	}
	
	/**
	 * @param string $package
	 * @return string
	 */
	private function getClosingXMLTag($package)
	{
		$parts = \explode('.', $package);
		return '</' . \array_pop($parts) . ':';
	}
}
