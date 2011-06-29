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
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	/**
     *  Designates events that are very
     *  harmful and will eventually lead to application failure.
     */
	const LEVEL_FATAL = 1000;
    /**
     *  Designates error events that might
     *  still allow the application to continue running.
     */
	const LEVEL_ERROR = 8;
    /**
     *  Designates events that could be
     *  harmful to the application operation.
     */
	const LEVEL_WARN = 8;
    /**
     *  Designates informational messages that
     *  highlight the progress of the application at coarse-grained level.
     */
	const LEVEL_INFO = 4;
    /**
     *  Designates informational level
     *  messages that are fine grained and most helpful when debugging an
     *  application.
     */
	const LEVEL_DEBUG = 2;
    /**
     *  Tells a target to process all messages.
     */
	const LEVEL_ALL = 0;

	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @serviceGen ignore
	 * @var string
	 */
	public $id;
	/**
	 * Set if included in logging setttings | LEVEL_*
	 *
	 * @var integer
	 */
    public $level;
	/**
	 * Human readable level
	 *
	 * @var string
	 */
    public $levelName;
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
	 * @var string
	 */
    public $category;
	/**
	 * Set if included in logging setttings
	 *
	 * @var string
	 */
    public $location;
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
	 * The amount of memory (in bytes) currently in use by Adobe¬¨√Ü Flash¬¨√Ü Player or Adobe¬¨√Ü AIR¬¨√Ü.
	 *
	 * @var integer
	 */
    public $totalMemory;
	/**
	 * Message
	 *
	 * @var string
	 */
    public $message;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		$this->id = 'report-' . \date('Y-m-d-H-i-s') . '-' . \md5(\microtime() . \uniqid());
	}
}
