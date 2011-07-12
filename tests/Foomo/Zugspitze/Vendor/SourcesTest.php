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
		$this->sources = new \Foomo\Flash\Vendor\Sources(array(\Foomo\Zugspitze\Module::getVendorDir('org.foomo.zugspitze'), \Foomo\Zugspitze\Module::getVendorDir('org.foomo.zugspitze.services')));
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testGetImplementationProject()
	{
		$project = $this->sources->getImplementationProject(\Foomo\Zugspitze\Tests\VendorHelper::SPARK_LIBRARY_ID, \Foomo\Zugspitze\Tests\VendorHelper::SPARK_EXAMPLES_ID);
		$this->assertNotNull($project);
	}

	public function testGetImplementationProjects()
	{
		$projects = $this->sources->getImplementationProjects(\Foomo\Zugspitze\Tests\VendorHelper::SPARK_LIBRARY_ID);
		$this->assertNotEquals(0, count($projects));
	}

	public function testGetImplementationProjectApplication()
	{
		$application = $this->sources->getImplementationProjectApplication(\Foomo\Zugspitze\Tests\VendorHelper::SPARK_EXAMPLES_ID, \Foomo\Zugspitze\Tests\VendorHelper::SPARK_EXAMPLES_APPLICATION_ID);
		$this->assertNotNull($application);
	}

	public function testGetImplementationProjectApplications()
	{
		$applications = $this->sources->getImplementationProjectApplications(\Foomo\Zugspitze\Tests\VendorHelper::SPARK_EXAMPLES_ID);
		$this->assertNotEquals(0, count($applications));
	}

	public function testGetLibrary()
	{
		$library = $this->sources->getLibrary(\Foomo\Zugspitze\Tests\VendorHelper::SERVICES_UPLOAD_LIBRARY_ID);
		$this->assertNotNull($library);
	}

	public function testGetLibraries()
	{
		$libraries = $this->sources->getLibraries();
		$this->assertTrue(count($libraries) > 0);
	}
}