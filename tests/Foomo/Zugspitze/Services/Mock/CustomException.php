<?php

namespace Foomo\Zugspitze\Services\Mock;

class CustomException extends \Exception
{
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @var string
	 */
	public $note = 'Hear my note!';
}