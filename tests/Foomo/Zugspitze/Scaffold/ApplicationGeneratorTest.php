<?php

namespace Foomo\Zugspitze\Scaffold;

class ApplicationGeneratorTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Scaffold\ApplicationGenerator
	 */
	private $generator;

	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
		$this->generator = \Foomo\Zugspitze\Scaffold::getApplicationGenerator(
			\Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID,
			\Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID,
			\Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_APPLICATION_ID,
			\Foomo\Zugspitze\TestSuite::TEST_PACKAGE
		);
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testRender()
	{
		$this->generator->render();
		$this->assertTrue(file_exists($this->generator->getBaseDir() . '/' . $this->generator->getWorkingDirName()), $this->generator->getBaseDir() . '/' . $this->generator->getWorkingDirName() . ' does not exist!?');
		$this->assertTrue(is_dir($this->generator->getBaseDir() . '/' . $this->generator->getWorkingDirName()), $this->generator->getBaseDir() . '/' . $this->generator->getWorkingDirName() . ' is not a folder!?');
	}

	public function testCreatePackage()
	{
		$this->generator->render();
		$this->generator->createPackage();
		$this->assertTrue(file_exists($this->generator->getBaseDir() . '/' . $this->generator->getArchiveFileName()), $this->generator->getBaseDir() . '/' . $this->generator->getArchiveFileName() . ' does not exist!?');
	}
}