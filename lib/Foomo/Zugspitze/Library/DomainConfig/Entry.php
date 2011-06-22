<?php

namespace Foomo\Zugspitze\Library\DomainConfig;

class Entry
{
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
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
	 * @var string[]
	 */
	public $projectLibraryIds = array();
}