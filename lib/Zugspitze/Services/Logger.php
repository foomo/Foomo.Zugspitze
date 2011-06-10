<?php

namespace Zugspitze\Services;

class Logger
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	const VERSION = 0.1;
	const LOGFILE_NAME = 'zugspitze.log';

	//---------------------------------------------------------------------------------------------
	// ~ Service methods
	//---------------------------------------------------------------------------------------------

	/**
	 * Log a error report
	 *
	 * @param Zugspitze\Services\Logger\Report $report
	 * @return boolean
	 */
	public function log($report)
	{
		$view = \Zugspitze\Module::getView('Zugspitze/Services/Logger/report.tpl', $report);
		$logFile = \Zugspitze\Module::getLogDir(__CLASS__) . '/' . self::LOGFILE_NAME;

		if ($report->screenshot && $report->screenshot->base64String) {

			$fileBinary = base64_decode($report->screenshot->base64String);
			$report->screenshot->file =  \Zugspitze\Module::getTmpDir() . '/' . $report->id . '.jpg';

			# save files
			if (!\file_put_contents($report->screenshot->file, $fileBinary)) \trigger_error('Could not create file ' . $report->screenshot->file);
		}

		if (!\file_exists($logFile)) \touch($logFile);
		\file_put_contents($logFile, $view->render(), FILE_APPEND | LOCK_EX);
		return true;
	}
}