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

namespace Foomo\Zugspitze\Services\Mock;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class ComplexType
{
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $typeString = 'foobar';
	/**
	 * @var int
	 */
	public $typeInt = 13;
	/**
	 * @var integer
	 */
	public $typeInteger = 13;
	/**
	 * @var float
	 */
	public $typeFloat = 13.3;
	/**
	 * @var double
	 */
	public $typeDouble = 13.3;
	/**
	 * @var string[]
	 */
	public $typeStringArray = array('foo', 'bar');
	/**
	 * @var int[]
	 */
	public $typeIntArray = array(13, 14);
	/**
	 * @var integer[]
	 */
	public $typeIntegerArray = array(13, 14);
	/**
	 * @var float[]
	 */
	public $typeFloatArray = array(13.3, 14.4);
	/**
	 * @var bool
	 */
	public $typeBool = false;
	/**
	 * @var boolean
	 */
	public $typeBoolean = false;
	/**
	 * @var bool[]
	 */
	public $typeBoolArray = array(true, false);
	/**
	 * @var boolean[]
	 */
	public $typeBooleanArray = array(true, false);
	/**
	 * @var mixed
	 */
	public $typeMixed = array('foo' => 'bar');
}