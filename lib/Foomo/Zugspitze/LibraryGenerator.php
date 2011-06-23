<?php

namespace Foomo\Zugspitze;

class LibraryGenerator
{
	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $libraryProjectIds
	 * @param string $sdkId
	 * @param string $report
	 * @return string SWC file name
	 */
	public static function compile($libraryProjectIds, $sdkId, &$report)
	{
		$sdk = \Foomo\Flex\DomainConfig::getInstance()->getEntry($sdkId);
		$includePaths = $sdk->sourcePaths;
		$sourcePaths = $sdk->sourcePaths;
		$externalLibs = $sdk->externalLibs;

		$sources = Vendor::getSources();
		foreach ($libraryProjectIds as $libraryProjectId) {
			$libraryProject = $sources->getLibraryProject($libraryProjectId);
			$sourcePaths[] = $libraryProject->pathname . '/src';
			$includePaths[] = $libraryProject->pathname . '/src';

			$libraryConfig = $sources->getLibrary($libraryProjectId);
			if (!$libraryConfig) continue;
			$sourcePaths = array_unique(array_merge($sourcePaths, $libraryConfig->getSources(true)));
			$externalLibs = array_unique(array_merge($externalLibs, $libraryConfig->getExternals(true)));
		}

		$swcFile = \Foomo\Flex\Utils::compileLibrarySWC($report, $sdk->sdkPath, $sourcePaths, $includePaths, $externalLibs);

		if (!file_exists($swcFile)) {
			throw new \Exception(
					'Adobe Compc (Flex Component Compiler) failed to create the swc.' . PHP_EOL .
					PHP_EOL .
					'This typically means, that there are incomplete phpDoc comments for your service classes method' . PHP_EOL .
					'parameters and / or return values and / or the corresponding value objects.' . PHP_EOL .
					'The resulting action script will have errors like' . PHP_EOL .
					PHP_EOL .
					'// missing type declaration' . PHP_EOL .
					'public var lastResult:;' . PHP_EOL .
					PHP_EOL .
					'see also what the flex compiler put to stdErr' . PHP_EOL .
					PHP_EOL .
					$report,
					1
			);
		}

		$filename = self::getSWCFileName($libraryProjectIds);

		if (!@rename($swcFile, $filename)) {
			throw new Exception('created swc ' . $swcFile . ' could not be moved to ' . $filename, 1);
		} else {
			$report .= 'moving created swc ' . $swcFile . ' to ' . $filename . PHP_EOL;
		}

		return $filename;
	}

	//---------------------------------------------------------------------------------------------
	// ~ Private static methods
	//---------------------------------------------------------------------------------------------

	/**
	 *
	 * @param string[] $libraryProjectIds
	 * @return string
	 */
	private static function getSWCFileName($libraryProjectIds)
	{
		return Module::getTmpDir() . DIRECTORY_SEPARATOR . 'Zugspitze-' . substr(md5(implode('.', $libraryProjectIds)), 0, 10) .'.swc';
	}
}