<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\Zugspitze\Services\Logger;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class Log
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
	 * Set if included in logging setttings
	 *
	 * @var string
	 */
    public $category;
	/**
	 * Message
	 *
	 * @var string
	 */
    public $message;
}