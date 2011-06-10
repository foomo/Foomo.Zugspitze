<?php

namespace Zugspitze\Scaffold\Config;

class Application
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var string
	 */
	public $name;
	/**
	 * @var string
	 */
	public $description;
	/**
	 * @var string
	 */
	public $package;
	/**
	 * @var boolean
	 */
	public $exclude;
	/**
	 * @var string[]
	 */
	public $sources;	
	/**
	 * @var string[]
	 */
	public $externals;	
}