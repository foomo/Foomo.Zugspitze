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
 */
class TestSuite extends \Foomo\TestRunner\Suite
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const LIBRARY_COUNT						= 6;
	const CORE_LIBRARY_ID					= 'org.foomo.zugspitze.core';
	const FLEX4_LIBRARY_ID					= 'org.foomo.zugspitze.flex4';
	const FLEX4_EXAMPLES_ID					= 'org.foomo.zugspitze.flex4.examples';
	const FLEX4_EXAMPLES_APPLICATION_ID		= 'org.foomo.zugspitze.flex4.examples.applications.blank';
	const SERVICES_UPLOAD_LIBRARY_ID		= 'org.foomo.zugspitze.services.upload';
	const TEST_PACKAGE						= 'org.foomo.tests.applications.blank';

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * get a list of class name, which will be accumulated into a test as a suite
	 *
	 * @return array
	 */
	public function foomoTestSuiteGetList()
	{
 		return array(
			'Foomo\\Zugspitze\\UploadTest',
			'Foomo\\Zugspitze\\VendorTest',
			'Foomo\\Zugspitze\\Vendor\\SourcesTest',
			'Foomo\\Zugspitze\\ScaffoldTest',
			'Foomo\\Zugspitze\\Services\\LoggerTest',
			'Foomo\\Zugspitze\\Services\\UploadTest',
			'Foomo\\Zugspitze\\Services\\CompilerTest',
			'Foomo\\Zugspitze\\Services\\ScaffoldTest',
			'Foomo\\Zugspitze\\Scaffold\\ApplicationGeneratorTest',
        );
	}
}