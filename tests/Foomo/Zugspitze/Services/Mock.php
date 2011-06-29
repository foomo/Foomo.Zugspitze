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

namespace Foomo\Zugspitze\Services;

/**
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author franklin <franklin@weareinteractive.com>
 */
class Mock
{
	//---------------------------------------------------------------------------------------------
	// ~ Constants
	//---------------------------------------------------------------------------------------------

	/**
	 * Service version
	 */
	const VERSION = 0.1;

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param int $value
	 * @return int
	 */
	public function getInt($value)
	{
		return $value;
	}

	/**
	 * @param float $value
	 * @return float
	 */
	public function getNumber($value)
	{
		return $value;
	}

	/**
	 * @param string $value
	 * @return string
	 */
	public function getString($value)
	{
		return $value;
	}

	/**
	 * Returns same as given
	 *
	 * @param bool $value given true | false
	 * @return bool returning true | false
	 */
	public function getBoolean($value)
	{
		return $value;
	}

	/**
	 * @param mixed $value
	 * @return mixed
	 */
	public function getObject($value)
	{
		return $value;
	}

	/**
	 * @param string[] $value
	 * @return string[]
	 */
	public function getArray($value)
	{
		return $value;
	}

	/**
	 * Returning complex type
	 *
	 * @param Foomo\Zugspitze\Services\Mock\ComplexType $value
	 * @return Foomo\Zugspitze\Services\Mock\ComplexType
	 */
	public function getComplexType($value)
	{
		return new Mock\ComplexType();
	}

	/**
	 * Returning shared object
	 *
	 * @return Foomo\Zugspitze\Services\Mock\SharedObject
	 */
	public function getSharedObject()
	{
		return new Mock\SharedObject();
	}

	/**
	 * Method throwing one type of exception
	 *
	 * @throws Foomo\Services\Types\Exception
	 * @return boolean
	 */
	public function getException()
	{
		throw new \Foomo\Services\Types\Exception('This is a mock exception', 500);
		return true;
	}

	/**
	 * Method throwing same type of exception
	 *
	 * @throws Foomo\Services\Types\Exception
	 * @return boolean
	 */
	public function getSameException()
	{
		throw new \Foomo\Services\Types\Exception('This is a second mock exception of the same type', 501);
		return true;
	}

	/**
	 * Method throwing two types of exceptions
	 *
	 * @throws Foomo\Zugspitze\Services\Mock\CustomException
	 * @throws Foomo\Services\Types\Exception
	 * @return boolean
	 */
	public function getCustomException()
	{
		throw new Mock\CustomException();
		return true;
	}

	/**
	 *
	 * @return boolean
	 */
	public function getMessage()
	{
		\Foomo\Services\RPC::addMessage('This is a single service message');
		return true;
	}

	/**
	 * @serviceMessage string
	 *
	 * @return boolean
	 */
	public function getMessages()
	{
		\Foomo\Services\RPC::addMessage('This is the first message');
		\Foomo\Services\RPC::addMessage('This is the second message');
		return true;
	}

	/**
	 * @serviceMessage Foomo\Zugspitze\Services\Mock\ComplexTypeMessage
	 *
	 * @return boolean
	 */
	public function getComplexTypeMessage()
	{
		\Foomo\Services\RPC::addMessage(new Mock\ComplexTypeMessage());
		return true;
	}
}