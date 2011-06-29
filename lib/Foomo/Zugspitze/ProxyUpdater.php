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

namespace Foomo\Zugspitze;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class ProxyUpdater
{
	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return string Filename
	 */
	public static function generateAntBuildFile($configId)
	{
		$sdk = \Foomo\Flash\Module::getCompilerConfig()->getEntry($configId);
		$view = Module::getView('Foomo\\Zugspitze\\ProxyUpdater', 'ProxyUpdater/AntBuildFile', $sdk);
		$fileName = tempnam(\Foomo\Zugspitze\Module::getTempDir(), 'proxyUpdater-');
		file_put_contents($fileName, $view->render());
		return $fileName;
	}

	/**
	 * host => Foomo\Services\ServiceDescription[]
	 *
	 * @return array
	 */
	public static function getServices()
	{
		return array($_SERVER['HTTP_HOST'] => \Foomo\Services\Utils::getAllLocalServiceDescriptions());
		//return array_merge(array($_SERVER['HTTP_HOST'] => \Foomo\Services\Utils::getAllLocalServiceDescriptions()), \Foomo\Services\Utils::getAllRemoteServiceDescriptions());
	}

	/**
	 * get the name of the ant file
	 *
	 * @return string
	 */
	public static function getAntBuildFileName()
	{
		return $_SERVER['HTTP_HOST'] .'-ProxyUpdater.xml';
	}

	/**
	 * @param string $filename Path to buildfile.xml
	 */
	public static function streamAntBuildFile($filename)
	{
		\Foomo\Utils::streamFile($filename, \Foomo\Zugspitze\ProxyUpdater::getAntBuildFileName(), 'text/xml', true);
	}
}