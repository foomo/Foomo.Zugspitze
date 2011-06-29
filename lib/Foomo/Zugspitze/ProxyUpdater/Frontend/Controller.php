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

namespace Foomo\Zugspitze\ProxyUpdater\Frontend;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class Controller
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var Foomo\Zugspitze\ProxyUpdater\Frontend\Model
	 */
	public $model;

	//---------------------------------------------------------------------------------------------
	// ~ Action methods
	//---------------------------------------------------------------------------------------------

	/**
	 * This method is executed by default
	 */
	public function actionDefault()
	{
	}

	/**
	 * Renders an ant file and pumps it out
	 */
	public function actionGetAntBuildFile($configId)
	{
		$this->model->filename = \Foomo\Zugspitze\ProxyUpdater::generateAntBuildFile($configId);
		if ($this->model->filename) {
			\Foomo\MVC::abort();
			\Foomo\Zugspitze\ProxyUpdater::streamAntBuildFile($this->model->filename);
			exit;
		}
	}
}
