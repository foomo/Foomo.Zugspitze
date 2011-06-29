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

namespace Foomo\Zugspitze\Scaffold\Frontend;

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
	 * model
	 *
	 * @var Foomo\Zugspitze\Scaffold\Frontend\Model
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
	 * Generates the scaffolding model, creates and streams the output containing the complete component as tgz file
	 *
	 * @param string $libraryProjectId
	 * @param string $implementationProjectId
	 * @param string $implementationProjectApplicationId
	 * @param string $packageName
	 */
	public function actionGenerateApplication($libraryProjectId, $implementationProjectId, $implementationProjectApplicationId, $packageName)
	{
		\Foomo\MVC::abort();
		$generator = \Foomo\Zugspitze\Scaffold::getApplicationGenerator($libraryProjectId, $implementationProjectId, $implementationProjectApplicationId, $packageName);
		$generator->render();
		$generator->createPackage();
		$generator->streamPackage();
		exit();
	}
}
