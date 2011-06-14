<?php

namespace Foomo\Zugspitze\Scaffold;

use Foomo\MVC\AbstractApp;

class Frontend extends AbstractApp
{
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		$HTMLDoc = \Foomo\HTMLDocument::getInstance();
		$HTMLDoc->addJavascripts(array(\Foomo\ROOT_HTTP . '/modules/' . \Foomo\Zugspitze\Module::NAME . '/js/scaffold.js'));
		$HTMLDoc->addJavascript('window.zugspitze.services.scaffold.server=\'\';window.zugspitze.services.scaffold.endPoint = \'' . \Foomo\ROOT_HTTP. '/modules/Foomo.Zugspitze/services/scaffold.php/Foomo.Services.RPC/serve\';');
	}
}
