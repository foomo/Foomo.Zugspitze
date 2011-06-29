<?php

namespace Foomo\Zugspitze\LibraryGenerator\Frontend;

/**
 *
 */
class Model
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $report;
	/**
	 * @var Foomo\Zugspitze\LibraryGenerator\Config\Preset[]
	 */
	public $presets;
	/**
	 * @var Foomo\Zugspitze\Vendor\Sources\Project[]
	 */
	public $libraryProjects;
	/**
	 * @var Foomo\Zugspitze\Vendor\Sources\Project[]
	 */
	public $coreLibraryProjects;
}