<?php
/**
 * Description of ZSCompilerServiceTestclass
 *
 * @author jan
 */
class ZSCompilerServiceTest extends PHPUnit_Framework_TestCase {
	/**
	 * me service
	 * 
	 * @var ZSCompilerService
	 */
	private $service;
	public function setUp()
	{
		$this->service = new ZSCompilerService;
	}
	public function testGetServices()
	{
		$services = $this->service->getServices();
		$this->assertTrue(($services[0] instanceOf ZSCompilerServiceModuleInfo));
	}
}
