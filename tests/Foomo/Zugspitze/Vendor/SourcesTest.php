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

namespace Foomo\Zugspitze\Vendor;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class SourcesTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\Vendor\Sources
	 */
	private $sources;

	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
		$this->sources = new \Foomo\Zugspitze\Vendor\Sources(\Foomo\Zugspitze\Module::getVendorDir() . '/sources');
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testUpdateProjects()
	{
		$this->sources = new \Foomo\Zugspitze\Vendor\Sources(\Foomo\Zugspitze\Module::getVendorDir() . '/sources', false);
		$this->assertTrue((count($this->sources->getLibraryProjects()) == 0));
		$this->sources->updateProjects();
		$this->assertFalse((count($this->sources->getLibraryProjects()) == 0));
	}

	public function testGetLibraryProject()
	{
		$library = $this->sources->getLibraryProject(\Foomo\Zugspitze\TestSuite::CORE_LIBRARY_ID);
		$this->assertNotNull($library);
	}

	public function testGetLibraryProjects()
	{
		$libraries = $this->sources->getLibraryProjects();
		$this->assertEquals(\Foomo\Zugspitze\TestSuite::LIBRARY_COUNT, count($libraries));

		$allLibraries = $this->sources->getLibraryProjects(false);
		$this->assertTrue(count($allLibraries) > count($libraries));
	}

	public function testGetLibraryProjectsByType()
	{
		$libraries = $this->sources->getLibraryProjectsByType(Sources\Project::TYPE_LIBRARY_PROJECT);
		$this->assertTrue(count($libraries) > 0);

		$allLibraries = $this->sources->getLibraryProjectsByType(Sources\Project::TYPE_CORE_LIBRARY_PROJECT);
		$this->assertTrue(count($allLibraries) > 0);

		$this->assertTrue(count($allLibraries) > count($libraries));
	}

	public function testGetImplementationProject()
	{
		$project = $this->sources->getImplementationProject(\Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID, \Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID);
		$this->assertNotNull($project);
	}

	public function testGetImplementationProjects()
	{
		$projects = $this->sources->getImplementationProjects(\Foomo\Zugspitze\TestSuite::FLEX4_LIBRARY_ID);
		$this->assertNotEquals(0, count($projects));
		#\var_dump($projects);
	}

	public function testGetImplementationProjectApplication()
	{
		$application = $this->sources->getImplementationProjectApplication(\Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID, \Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_APPLICATION_ID);
		$this->assertNotNull($application);
	}

	public function testGetImplementationProjectApplications()
	{
		$applications = $this->sources->getImplementationProjectApplications(\Foomo\Zugspitze\TestSuite::FLEX4_EXAMPLES_ID);
		$this->assertNotEquals(0, count($applications));
		#\var_dump($projects);
	}

	public function testGetLibrary()
	{
		$library = $this->sources->getLibrary(\Foomo\Zugspitze\TestSuite::SERVICES_UPLOAD_LIBRARY_ID);
		$this->assertNotNull($library);
	}

	public function testGetLibraries()
	{
		$libraries = $this->sources->getLibraries();
		$this->assertTrue(count($libraries) > 0);
	}
}