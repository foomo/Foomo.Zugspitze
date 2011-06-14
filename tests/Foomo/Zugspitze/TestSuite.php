<?php

namespace Foomo\Zugspitze;

class TestSuite extends \Foomo\TestRunner\Suite
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const LIBRARY_COUNT						= 7;
	const CORE_LIBRARY_ID					= 'org.foomo.zugspitze.core';
	const FLEX4_LIBRARY_ID					= 'org.foomo.zugspitze.flex4';
	const FLEX4_EXAMPLES_ID					= 'org.foomo.zugspitze.flex4.examples';
	const FLEX4_EXAMPLES_APPLICATION_ID		= 'org.foomo.zugspitze.flex4.examples.applications.blank';
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
			'Foomo\\Zugspitze\\ScaffoldTest',
			'Foomo\\Zugspitze\\Scaffold\\ConfigTest',
			'Foomo\\Zugspitze\\Services\\LoggerTest',
			'Foomo\\Zugspitze\\Services\\UploadTest',
			'Foomo\\Zugspitze\\Services\\ScaffoldTest',
        );
	}
}