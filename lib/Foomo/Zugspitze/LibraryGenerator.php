<?php

namespace Foomo\Zugspitze;

class LibraryGenerator
{
	//---------------------------------------------------------------------------------------------
	// ~ Public static methods
	//---------------------------------------------------------------------------------------------

	/**
	 * @param string $libraryProjectIds
	 * @param string $configId
	 * @param string $report
	 * @return string SWC file name
	 */
	public static function compile($libraryProjectIds, $configId, &$report)
	{
		$flexConfigEntry = \Foomo\Flex\DomainConfig::getInstance()->getEntry($configId);

		$compc = \Foomo\CliCall\Compc::create(
					$flexConfigEntry->sdkPath,
					$flexConfigEntry->sourcePaths,
					$flexConfigEntry->externalLibs,
					$flexConfigEntry->sourcePaths
				);

		$includePaths = $flexConfigEntry->sourcePaths;
		$sourcePaths = $flexConfigEntry->sourcePaths;
		$externalLibs = $flexConfigEntry->externalLibs;

		$sources = Vendor::getSources();
		foreach ($libraryProjectIds as $libraryProjectId) {
			$libraryProject = $sources->getLibraryProject($libraryProjectId);
			$compc->addSourcePaths(array($libraryProject->pathname . '/src'));
			$compc->addIncludeSources(array($libraryProject->pathname . '/src'));

			$libraryConfig = $sources->getLibrary($libraryProjectId);
			if (!$libraryConfig) continue;
			$compc->addSourcePaths($libraryConfig->getSources(true));
			$compc->addIncludeSources($libraryConfig->getSources(true));
			$compc->addExternalLibraryPaths($libraryConfig->getExternals(true));
		}

		$compc->compileSwc(self::getSWCFileName($libraryProjectIds));

		if (!file_exists(self::getSWCFileName($libraryProjectIds))) {
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

		return self::getSWCFileName($libraryProjectIds);
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