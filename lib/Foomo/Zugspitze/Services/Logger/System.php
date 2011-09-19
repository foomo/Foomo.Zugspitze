<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foomo\Zugspitze\Services\Logger;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class System
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * @var integer
	 */
	public $uptime;
	/**
	 * @var integer
	 */
	public $freeMemory;
	/**
	 * @var integer
	 */
	public $totalMemory;
	/**
	 * @var integer
	 */
	public $privateMemory;
}