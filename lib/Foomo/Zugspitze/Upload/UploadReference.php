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

namespace Foomo\Zugspitze\Upload;

/**
 * value object containing flash client side of an uploaded file plus its uploadId
 *
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author jan <jan@bestbytes.de>
 * @Foomo\Services\Reflection\RemoteClass(package='org.foomo.zugspitze.services.upload.vos')
 */
class UploadReference
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