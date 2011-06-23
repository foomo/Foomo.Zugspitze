<?php

namespace Foomo\Zugspitze\Scaffold;

class ApplicationGenerator
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
	 * @var Foomo\Zugspitze\Vendor\Sources\Project
	 */
	private $libraryProject;
	/**
	 * @var Foomo\Zugspitze\Vendor\Sources\Project
	 */
	private $implementationProject;
	/**
	 * @var Foomo\Zugspitze\Vendor\Sources\Application
	 */
	private $implementationProjectApplication;
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
	private $packageName;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * @param Foomo\Zugspitze\Vendor\Sources\Project $libraryProject
	 * @param Foomo\Zugspitze\Vendor\Sources\Project $implementationProject
	 * @param Foomo\Zugspitze\Vendor\Sources\Application $implementationProjectApplication
	 * @param string $packageName
	 */
	public function __construct(\Foomo\Zugspitze\Vendor\Sources\Project $libraryProject, \Foomo\Zugspitze\Vendor\Sources\Project $implementationProject, \Foomo\Zugspitze\Vendor\Sources\Application $implementationProjectApplication, $packageName)
	{
		# set values
		$this->libraryProject = $libraryProject;
		$this->implementationProject = $implementationProject;
		$this->implementationProjectApplication = $implementationProjectApplication;

		$this->packageName = $packageName;

		$this->baseDir = \Foomo\Zugspitze\Module::getTmpDir(__CLASS__);
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

		$fromFiles = $this->implementationProjectApplication->getFiles();
		$toFiles = $this->getToFiles($fromFiles, $this->implementationProjectApplication->package, $this->packageName);

		for ($i=0; $i<count($fromFiles); $i++) {
			$fromFile = $this->implementationProjectApplication->pathname . \DIRECTORY_SEPARATOR . $fromFiles[$i];
			$toFile = $this->workingDir . \DIRECTORY_SEPARATOR . $toFiles[$i];
			$toDir = $this->dirname($toFile);
			$this->mkdir($toDir, self::UMASK_DIR);
			$this->copy($fromFile, $toFile);

			$search = array(
				$this->getXMLNamespace($this->implementationProjectApplication->package),
				$this->getOpeningXMLTag($this->implementationProjectApplication->package),
				$this->getClosingXMLTag($this->implementationProjectApplication->package),
				$this->implementationProjectApplication->package
			);
			$replace = array(
				$this->getXMLNamespace($this->packageName),
				$this->getOpeningXMLTag($this->packageName),
				$this->getClosingXMLTag($this->packageName),
				$this->packageName
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
		\Foomo\Utils::streamFile($this->baseDir . DIRECTORY_SEPARATOR . $this->getArchiveFileName(), $this->getArchiveFileName(), '	application/x-gzip', true);
	}

	/**
	 * @return string
	 */
	public function getWorkingDirName()
	{
		return $this->libraryProject->id . '_' . $this->packageName;
	}

	/**
	 * @return string
	 */
	public function getArchiveFileName()
	{
		return $this->getWorkingDirName() . '.tgz';
	}

	/**
	 * @return string
	 */
	public function getBaseDir()
	{
		return $this->baseDir;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------

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