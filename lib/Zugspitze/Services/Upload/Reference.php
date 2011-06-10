<?php

namespace Zugspitze\Services\Upload;

/**
 * value object containing flash client side of an uploaded file plus its uploadId
 *
 * @see flash docs flash.net.FileReference
 * @Foomo\Services\Reflection\RemoteClass(package='com.bestbytes.services.sharedVo')
 */
class Reference 
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * upload id - references the upload on the server
	 *
	 * @var string
	 */
	public $id;
	/**
	 * name of the creator
	 *
	 * @var string
	 */
	public $creator;
	/**
	 * extension of the file air only
	 *
	 * @var string
	 */
	public $extension;
	/**
	 * name on the local disk
	 *
	 * @var string
	 */
	public $name;
	/**
	 * a flash mess
	 *
	 * @see the flash docs FileReference
	 *
	 * @var string
	 */
	public $type;
	/**
	 * filesize in bytes
	 *
	 * @var integer
	 */
	public $size;
	/**
	 * date of creation
	 *
	 * @var integer
	 */
	public $creationDate;
	/**
	 * date of last mod
	 *
	 * @var integer
	 */
	public $modificationDate;
}