<?php

namespace Foomo\Zugspitze;

class ScaffoldTest extends \PHPUnit_Framework_TestCase
{
	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------

	public function setUp()
	{
	}

	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testGetApplicationGenerator()
	{
		$generator = Scaffold::getApplicationGenerator(TestSuite::FLEX4_LIBRARY_ID, TestSuite::FLEX4_EXAMPLES_ID, TestSuite::FLEX4_EXAMPLES_APPLICATION_ID, TestSuite::TEST_PACKAGE);
		$this->assertNotNull($generator);
	}
}