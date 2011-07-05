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

namespace Foomo\Zugspitze\Scaffold;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 * @todo find better place for constants and rename
 */
class ApplicationGeneratorTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const LIBRARY_COUNT						= 6;
	const CORE_LIBRARY_ID					= 'org.foomo.zugspitze.core';
	const FLEX4_LIBRARY_ID					= 'org.foomo.zugspitze.spark';
	const FLEX4_EXAMPLES_ID					= 'org.foomo.zugspitze.spark.examples';
	const FLEX4_EXAMPLES_APPLICATION_ID		= 'org.foomo.zugspitze.spark.applications.blank';
	const SERVICES_UPLOAD_LIBRARY_ID		= 'org.foomo.zugspitze.services.upload';
	const TEST_PACKAGE						= 'org.foomo.tests.applications.blank';

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
			self::FLEX4_LIBRARY_ID,
			self::FLEX4_EXAMPLES_ID,
			self::FLEX4_EXAMPLES_APPLICATION_ID,
			self::TEST_PACKAGE
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