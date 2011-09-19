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

namespace Foomo\Zugspitze\Services\Logger;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class Report
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @serviceGen ignore
	 * @var string
	 */
	public $id;
	/**
	 * Set if included in logging setttings | DD-MM-YYY
	 *
	 * @var string
	 */
    public $date;
	/**
	 * Set if included in logging setttings | HH:MM:SS
	 *
	 * @var string
	 */
    public $time;
	/**
	 * Set if included in logging setttings
	 *
	 * @var Foomo\Zugspitze\Services\Logger\Screenshot
	 */
    public $screenshot;
	/**
	 * Set if included in logging setttings
	 *
	 * @var Foomo\Zugspitze\Services\Logger\Capabilities
	 */
    public $capabilities;
	/**
	 * System data
	 *
	 * @var Foomo\Zugspitze\Services\Logger\System
	 */
    public $system;
	/**
	 * @var Foomo\Zugspitze\Services\Logger\Log
	 */
	public $log;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		$this->id = 'report-' . \date('Y-m-d-H-i-s') . '-' . \md5(\microtime() . \uniqid());
	}
}
