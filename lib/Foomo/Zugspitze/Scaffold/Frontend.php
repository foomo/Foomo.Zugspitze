<?php

namespace Foomo\Zugspitze\Scaffold;

class Frontend extends \Foomo\MVC\AbstractApp
{
	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		$HTMLDoc = \Foomo\HTMLDocument::getInstance();
		$HTMLDoc->addJavascripts(array(\Foomo\ROOT_HTTP . '/modules/' . \Foomo\Zugspitze\Module::NAME . '/js/services/Scaffold.js'));
		$HTMLDoc->addJavascripts(array(\Foomo\ROOT_HTTP . '/modules/' . \Foomo\Zugspitze\Module::NAME . '/js/applicationGenerator.js'));
		$HTMLDoc->addJavascript('window.Foomo.Zugspitze.Services.Scaffold.server=\'\';window.Foomo.Zugspitze.Services.Scaffold.endPoint = \'' . \Foomo\ROOT_HTTP. '/modules/Foomo.Zugspitze/services/scaffold.php/Foomo.Services.RPC/serve\';');
	}
}
