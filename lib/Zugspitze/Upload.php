<?php

namespace Zugspitze;

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
		return \Zugspitze\Module::getTmpDir(__CLASS__);
	}
}