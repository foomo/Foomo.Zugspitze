<?php

namespace Zugspitze;

use Foomo\MVC\AbstractApp;
use Foomo\Modules\ModuleAppInterface;
/**
 * manage zugspitze
 */
class Frontend extends AbstractApp implements ModuleAppInterface {
	public function __construct() 
	{
		$HTMLDoc = \Foomo\HTMLDocument::getInstance();
		$HTMLDoc->addStylesheets(array(\Foomo\ROOT_HTTP . '/modules/' . \Zugspitze\Module::NAME . '/css/module.css'));
		parent::__construct(get_class($this));
	}
}