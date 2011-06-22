<?php

namespace Foomo\Zugspitze;

class Vendor
{
	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @return Foomo\Zugspitze\Vendors\Sources
	 */
	public static function getSources()
	{
		return new Vendor\Sources(\Foomo\Zugspitze\Module::getVendorDir() . DIRECTORY_SEPARATOR . 'sources');
	}
}