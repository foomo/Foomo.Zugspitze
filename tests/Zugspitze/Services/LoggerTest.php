<?php

namespace Zugspitze\Services;

class LoggerTest extends \PHPUnit_Framework_TestCase 
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Zugspitze\Services\Logger
	 */
	private $service;
	
	//---------------------------------------------------------------------------------------------
	// ~ Setup
	//---------------------------------------------------------------------------------------------
	
	public function setUp()
	{
		$this->service = new \Zugspitze\Services\Logger();
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Test methods
	//---------------------------------------------------------------------------------------------

	public function testLog()
	{
		$result = $this->service->log($this->getReport());
		$logFile = \Zugspitze\Module::getLogDir('Zugspitze\Services\Logger') . '/' . \Zugspitze\Services\Logger::LOGFILE_NAME;
		$this->assertTrue($result);
		$this->assertTrue(\file_exists($logFile));
	}
	
	//---------------------------------------------------------------------------------------------
	// ~ Private methods
	//---------------------------------------------------------------------------------------------
	
	/**
	 * @return Zugspitze\Services\Logger\Report 
	 */
	private function getReport()
	{
		$report = new \Zugspitze\Services\Logger\Report();
		$report->category = 'some.random.category';
		$report->date = '15-10-2010';
		$report->level = \Zugspitze\Services\Logger\Report::LEVEL_DEBUG;
		$report->levelName = 'DEBUG';
		$report->location = '/src/com/bestbytes/zugspitze/apps/FlexApplication.as:264';
		$report->time = '19:31:05';
		$report->message = 'Caught uncaught Error';
		$report->totalMemory = 138481664;
		$report->capabilities = new \Zugspitze\Services\Logger\Capabilities();
		$report->capabilities->os = 'Mac OS 10.6.4';
		$report->capabilities->version = 'MAC 10,1,85,3';
		$report->capabilities->language = 'en';
		$report->capabilities->playerType = 'PlugIn';
		$report->capabilities->manufacturer = 'Adobe Macintosh';
		$report->capabilities->screenDPI = 72;
		$report->capabilities->screenColor = 'color';
		$report->capabilities->pixelAspectRatio = 1;
		$report->capabilities->screenResolutionX = 2560;
		$report->capabilities->screenResolutionY = 1600;
		$report->capabilities->avHardwareDisable = false;
		$report->capabilities->hasAccessibility = false;
		$report->capabilities->hasAudio = true;
		$report->capabilities->hasAudioEncoder = true;
		$report->capabilities->hasIME = true;
		$report->capabilities->hasMP3 = true;
		$report->capabilities->hasPrinting = true;
		$report->capabilities->hasScreenBroadcast = false;
		$report->capabilities->hasScreenPlayback = false;
		$report->capabilities->hasStreamingAudio = true;
		$report->capabilities->hasStreamingVideo = true;
		$report->capabilities->hasTLS = true;
		$report->capabilities->hasVideoEncoder = true;
		$report->capabilities->isDebugger = true;
		$report->capabilities->localFileReadDisable = false;
		$report->capabilities->maxLevelIDC = '5.1';
		$report->capabilities->supports32BitProcesses = true;
		$report->capabilities->supports64BitProcesses = true;
		return $report;
	}
}