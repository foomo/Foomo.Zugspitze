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

namespace Foomo\Zugspitze\Services\Upload;

/**
 * class describing a file upload
 * be careful wit these data, they are user input
 *
 * @link www.foomo.org
 * @license www.gnu.org/licenses/lgpl.txt
 * @author jan <jan@bestbytes.de>
 * @author franklin <franklin@weareinteractive.com>
 */
class Info
{
	//---------------------------------------------------------------------------------------------
	// ~ Variables
	//---------------------------------------------------------------------------------------------

	/**
	 * name of the file on the client computer
	 *
	 * @var string
	 */
	public $name = '';
	/**
	 * mime type of the file - do not necessarily trust this
	 *
	 * @var string
	 */
	public $mimeType = '';
	/**
	 * you may want to use self::moveTo() instead
	 *
	 * temporary location of the file, if you want to use it, then move it from here
	 *
	 * @var string
	 */
	public $tempName = '';
	/**
	 * error
	 *
	 * @var integer
	 */
	public $error = 0;
	/**
	 * file size of the upload
	 *
	 * @var integer
	 */
	public $size = 0;
	/**
	 * id of the upload
	 *
	 * @var string
	 */
	public $id;
	/**
	 * time stamp when the file was uploaded
	 *
	 * @var integer
	 */
	public $uploadTime;
	/**
	 * session in which the file was uploaded
	 *
	 * @var string
	 */
	public $uploadSessionId;
	/**
	 * ip the file is coming from
	 *
	 * @var string
	 */
	public $uploadIp;

	//---------------------------------------------------------------------------------------------
	// ~ Constructor
	//---------------------------------------------------------------------------------------------

	/**
	 * translate an upload array into a proper object
	 *
	 * @param string $id of the upload
	 * @param array $uploadArray from $_FILES
	 */
	public function __construct($id, $uploadArray = null)
	{
		$this->id         = $id;
		$this->uploadTime = time();

		if($uploadArray) {
			$this->name       = $uploadArray['name'];
			$this->mimeType   = $uploadArray['type'];
			$this->tempName   = $uploadArray['tmp_name'];
			$this->error      = $uploadArray['error'];
			$this->size       = $uploadArray['size'];
		}
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public methods
	//---------------------------------------------------------------------------------------------

	/**
	 *
	 * @param string $pathname
	 * @return boolean
	 */
	public function moveTo($pathname)
	{
		return rename($this->tempName, $pathname);
	}

	/**
	 * @return int
	 */
	public function persist()
	{
		return file_put_contents(self::getFile($this->id), serialize($this));
	}

	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------


	/**
	 * @param string $uploadId
	 * @return mixed
	 */
	public static function load($uploadId)
	{
		$file = self::getFile($uploadId);
		if(file_exists($file) && ($unserialized = unserialize(file_get_contents($file)))) {
			return $unserialized;
		} else {
			trigger_error('could not retrieve upload with id ' . $uploadId, E_USER_WARNING);
		}
	}

	/**
	 * @param string $uploadId
	 * @return string
	 */
	private static function getFile($uploadId)
	{
		return \Foomo\Zugspitze\Module::getTempDir('Upload'). DIRECTORY_SEPARATOR . 'upload-' . $uploadId . '.info.ser';
	}
}