<?php

namespace Foomo\Zugspitze\Library;

class Frontend extends \Foomo\MVC\AbstractApp
{
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		$HTMLDoc = \Foomo\HTMLDocument::getInstance();
		$HTMLDoc->addJavascripts(array(\Foomo\ROOT_HTTP . '/modules/' . \Foomo\Zugspitze\Module::NAME . '/js/library.js'));
	}
}
