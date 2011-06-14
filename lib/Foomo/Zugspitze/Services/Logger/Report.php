<?php
namespace Foomo\Zugspitze\Services\Logger;

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
	 * The amount of memory (in bytes) currently in use by Adobe¬Æ Flash¬Æ Player or Adobe¬Æ AIR¬Æ.
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
