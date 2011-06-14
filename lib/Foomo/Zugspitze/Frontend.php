<?php

namespace Foomo\Zugspitze;

/**
 * manage zugspitze
 */
class Frontend extends \Foomo\MVC\AbstractApp implements \Foomo\Modules\ModuleAppInterface
{
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		$HTMLDoc = \Foomo\HTMLDocument::getInstance();
		$HTMLDoc->addStylesheets(array(\Foomo\ROOT_HTTP . '/modules/' . \Foomo\Zugspitze\Module::NAME . '/css/module.css'));
		parent::__construct(get_class($this));
	}
}