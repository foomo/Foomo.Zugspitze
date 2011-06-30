<?php
/* @var $view Foomo\View */
/* @var $model Foomo\Flash\Flex\CompilerConfig\Entry */
/* @var $serviceDescription Foomo\Services\ServiceDescription */
$data = array();
foreach ($model['libraryProjectIds'] as $libraryProjectId) $data[] = 'projectLibraryIds%5B%5D=' . $libraryProjectId;
$post = implode('&amp;', $data);
?>
<?= '<?xml version="1.0" encoding="ISO-8859-1"?>' . PHP_EOL ?>
<project name="<?= htmlspecialchars($_SERVER['HTTP_HOST']) ?>" basedir=".">
	<!-- generated on <?= htmlspecialchars($_SERVER['HTTP_HOST']); ?> at <?= date('Y-m-d H:i:s'); ?>-->
	<target name="updateAntFile" description="Update and download the ant file itself">
        <echo message="updating this ant file"/>
		<exec executable="/usr/bin/curl">
			<arg value="-k"/>
			<arg value="<?= Foomo\Utils::getServerUrl(false, true) . Foomo\Zugspitze\Module::getHtdocsPath() . '/libraryGenerator.php/Foomo.Zugspitze.LibraryGenerator/getAntBuildFile/' . $model['configId'] ?>"/>
			<arg value="--data"/>
			<arg value="<?= $post ?>"/>
			<arg value="-o"/>
			<arg value="./Zugspitze-update.xml"/>
		</exec>
    </target>
	<target name="updateSwcFile" description="Update and download the Zugspitze swc">
        <echo message="updating the Zugspitze.swc"/>
		<exec executable="/usr/bin/curl">
			<arg value="-k"/>
			<arg value="<?= Foomo\Utils::getServerUrl(false, true) . Foomo\Zugspitze\Module::getHtdocsPath() . '/libraryGenerator.php/Foomo.Zugspitze.LibraryGenerator/compileLibrary/' . $model['configId'] ?>"/>
			<arg value="--data"/>
			<arg value="<?= $post ?>"/>
			<arg value="-o"/>
			<arg value="../libs/Zugspitze.swc"/>
		</exec>
    </target>
</project>