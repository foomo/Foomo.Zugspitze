<?php

namespace Foomo\Zugspitze\Services\Mock;

/**
 * Basic standard types
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