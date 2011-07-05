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

namespace Foomo\Zugspitze;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 * @todo find better place for constants and rename
 */
class VendorTest extends \PHPUnit_Framework_TestCase
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
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testGetSources()
	{
		$this->assertNotNull(Flash\Vendor::getSources(array(\Foomo\Zugspitze\Module::getBaseDir('vendor/org.foomo.zugspitze'))));
	}
}