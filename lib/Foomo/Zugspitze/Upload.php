<?php

namespace Foomo\Zugspitze;

/**
 * easy way to handle file uploads
 */
class Upload
{
	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return string
	 */
	public static function getTmpDir()
	{
		return \Foomo\Zugspitze\Module::getTmpDir(__CLASS__);
	}
}