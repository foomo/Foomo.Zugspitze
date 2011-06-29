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

namespace Foomo\Zugspitze\LibraryGenerator\Frontend;

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
	 * @var Foomo\Zugspitze\LibraryGenerator\Frontend\Model
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
		$this->model->presets = \Foomo\Zugspitze\Module::getLibraryGeneratorConfig()->getPresets();
		$this->model->libraryProjects = \Foomo\Zugspitze\Vendor::getSources()->getLibraryProjectsByType(\Foomo\Zugspitze\Vendor\Sources\Project::TYPE_LIBRARY_PROJECT, false);
		$this->model->coreLibraryProjects = \Foomo\Zugspitze\Vendor::getSources()->getLibraryProjectsByType(\Foomo\Zugspitze\Vendor\Sources\Project::TYPE_CORE_LIBRARY_PROJECT, false);
	}

	/**
	 * @param string[] $projectLibraryIds
	 */
	public function actionCompileLibrary($sdkId)
	{
		$projectLibraryIds = $_POST['projectLibraryIds'];
		if (is_null($projectLibraryIds) || empty($projectLibraryIds)) \Foomo\MVC::redirect ('default');
		$filename = \Foomo\Zugspitze\LibraryGenerator::compile($projectLibraryIds, $sdkId, $this->model->report);
		if (file_exists($filename)) {
			\Foomo\MVC::abort();
			\Foomo\Utils::streamFile($filename, 'Zugspitze.swc', 'application/octet-stream', true);
			exit;
		}
	}
}
