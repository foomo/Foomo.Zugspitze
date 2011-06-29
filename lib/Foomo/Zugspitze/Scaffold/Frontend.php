<?php

/*
 * This file is part of the foomo Opensource Framework.
 *
 * The foomo Opensource Framework is free software: you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General Public License as
 * published  by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * The foomo Opensource Framework is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along with
 * the foomo Opensource Framework. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Foomo\Zugspitze\Scaffold;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
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
