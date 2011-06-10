<?php

namespace Zugspitze;

class TestSuite extends \Foomo\TestRunner\Suite 
{
	/**
	 * get a list of class name, which will be accumulated into a test as a suite
	 *
	 * @return array
	 */
	public function foomoTestSuiteGetList()
	{
 		return array(
			'Zugspitze\\UploadTest',
			'Zugspitze\\ScaffoldTest',
			'Zugspitze\\Scaffold\\ConfigTest',
			'Zugspitze\\Services\\LoggerTest',
			'Zugspitze\\Services\\UploadTest',
			'Zugspitze\\Services\\ScaffoldTest',
        );
	}
}