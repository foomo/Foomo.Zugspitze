<?php

namespace Zugspitze\Services\Upload;

/**
 * Class describing a file upload
 *
 * be careful wit these data, they are user input
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
		return \Zugspitze\Upload::getTmpDir(). DIRECTORY_SEPARATOR . 'upload-' . $uploadId . '.info.ser';
	}
}