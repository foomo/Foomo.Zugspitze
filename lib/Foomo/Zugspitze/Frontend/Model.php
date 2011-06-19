<?php

namespace Foomo\Zugspitze\Frontend;

/**
 * model
 */
class Model
{

	/**
	 * list all available apps
	 *
	 * @return RadAppASClass[]
	 */
	public static function getAvaliableApps()
	{
		$classes = array_keys(\Foomo\AutoLoader::getClassMap());
		$ret = array();
		$keys = array();
		foreach ($classes as $className) {
			if (class_exists($className)) {
				try {
					$ref = new \ReflectionAnnotatedClass($className);
					if ($ref->hasAnnotation('RadAppASClass')) {
						$a = $ref->getAnnotation('RadAppASClass');

						if (!empty($a->packageName)) {
							$key = $a->packageName . '.' . $a->className;
						} else {
							$key = $a->className;
						}
						$keys[] = $key;
						$ret[$key] = $a;
					}
				} catch (\Exception $e) {
					// nothing
				}
			}
		}

		sort($keys, SORT_STRING);
		$result = array();
		foreach ($keys as $key) {
			$result[$key] = $ret[$key];
		}
		return $result;
	}

	/**
	 * generate the server class code
	 *
	 * @param string $fullClassName the full class name including the package sth. like com.bestbytes.apps.MyApp
	 *
	 * @return string
	 *
	 */
	public static function generateAppPHP($fullClassName, $description)
	{
		return self::generateClass('appWizard/RadAppPHP.tpl', $fullClassName, $description);
	}

	/**
	 * generate the flex code
	 *
	 * @param string $fullClassName the full class name including the package sth. like com.bestbytes.apps.MyApp
	 *
	 * @return string
	 *
	 */
	public static function generateAppFlex($fullClassName, $description)
	{
		return self::generateClass('zugspitze/appWizard/RadAppMXML.tpl', $fullClassName, $description);
	}

	private function generateClass($templateFile, $fullClassName, $description)
	{
		$model = array(
			'description' => $description,
			'asClass' => self::parseFullClassName($fullClassName)
		);
		$view = \Foomo\Zugspitze\Module::getView($this, $template, $model); //RadModuleZugspitze::getView($templateFile, $model);
		return $view->render();
	}

	/**
	 * write the php app to the file system
	 *
	 * @param string $fullClassName the full class name including the package sth. like com.bestbytes.apps.MyApp
	 *
	 * @return false
	 *
	 */
	public static function writePHPApp($fullClassName, $description, $moduleName)
	{
		if ($fullClassName == '') {
			throw new \Exception('class name can not be empty', 1);
		}
		if (self::appExists($fullClassName)) {
			throw new \Exception('the class ' . $fullClassName . ' already exists', 1);
		} else {
			$php = self::generateAppPHP($fullClassName, $description);
			file_put_contents(self::getAppClassFilename($fullClassName, $moduleName), $php);
			\Foomo\AutoLoader::resetCache();
			if (!self::appExists($fullClassName)) {
				throw new \Exception('the class file was written, but the autoloader could not register the newly created class', 1);
			}
			return true;
		}
	}

	public static function getAppClassFilename($fullClassName, $moduleName)
	{
		$appClass = self::parseFullClassName($fullClassName);
		$classFileName = $appClass->className . '.class.php';
		$moduleLibFolder = \Foomo\ROOT . '/modules/' . $moduleName . '/lib';
		$fullFolder = $moduleLibFolder . '/apps';

		$fileName = $fullFolder . '/' . $classFileName;
		if (!is_dir($moduleLibFolder)) {
			throw new \Exception('invalid module ' . $moduleName . ' with lib ' . $moduleLibFolder);
		}
		if (!is_dir($fullFolder)) {
			mkdir($fullFolder);
		}
		if (!is_dir(dirname($fileName)) || !is_writable(dirname($fileName))) {
			throw new \Exception('can not write class into ' . dirname($fileName), 1);
		}
		if (file_exists($fileName)) {
			throw new \Exception('class file already exists :(' . $fileName, 1);
		}
		return $fileName;
	}

	/**
	 * check if the app exists
	 *
	 * @param string $fullClassName the full class name including the package sth. like com.bestbytes.apps.MyApp
	 *
	 * @return boolean
	 */
	public static function appExists($fullClassName)
	{
		$appClass = self::parseFullClassName($fullClassName);
		return class_exists($appClass->className);
	}

	/**
	 * get info about the class
	 *
	 * @param string $fullClassName the full class name including the package sth. like com.bestbytes.apps.MyApp
	 *
	 * @return stdClass
	 */
	public static function parseFullClassName($fullClassName)
	{
		$parts = explode('.', $fullClassName);
		$ret = array(
			'className' => array_pop($parts),
			'packageName' => implode('.', $parts)
		);
		if (class_exists($ret['className'])) {
			try {
				$ref = new \ReflectionAnnotatedClass($ret['className']);
				$docEntry = new \Foomo\Reflection\PhpDocEntry($ref->getDocComment());
				$ret['description'] = $docEntry->comment;
			} catch (\Exception $e) {
				// nothing
			}
		}
		return (object) $ret;
	}

}