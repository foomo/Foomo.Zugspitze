<?php

namespace Foomo\Zugspitze\Services;

/**
 * Service documentation
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