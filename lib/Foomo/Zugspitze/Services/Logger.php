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

namespace Foomo\Zugspitze\Services;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
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
	 * @param Foomo\Zugspitze\Services\Logger\Report $report
	 * @return boolean
	 */
	public function log($report)
	{
		$view = \Foomo\Zugspitze\Module::getView(__CLASS__, 'Logger/report.tpl', $report);
		$logFile = \Foomo\Zugspitze\Module::getLogDir() . '/' . self::LOGFILE_NAME;

		if ($report->screenshot && $report->screenshot->base64String) {

			$fileBinary = base64_decode($report->screenshot->base64String);
			$report->screenshot->file =  \Foomo\Zugspitze\Module::getTempDir() . '/' . $report->id . '.jpg';

			# save files
			if (!\file_put_contents($report->screenshot->file, $fileBinary)) \trigger_error('Could not create file ' . $report->screenshot->file);
		}

		if (!\file_exists($logFile)) \touch($logFile);
		\file_put_contents($logFile, $view->render(), FILE_APPEND | LOCK_EX);
		return true;
	}
}