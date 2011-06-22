<?php
/* @var $view Foomo\View */
/* @var $model Foomo\Flex\DomainConfig\Entry */
/* @var $serviceDescription Foomo\Services\ServiceDescription */
?>
<?= '<?xml version="1.0" encoding="ISO-8859-1"?>' . PHP_EOL ?>
<project name="<?= htmlspecialchars($_SERVER['HTTP_HOST']) ?>" basedir=".">
	<!-- generated on <?= htmlspecialchars($_SERVER['HTTP_HOST']); ?> at <?= date('Y-m-d H:i:s'); ?>-->
	<target name="updateMyself" description="Update and download the ant file itself">
        <echo message="updating this ant file"/>
		<exec executable="/usr/bin/curl">
			<arg value="-k"/>
			<arg value="<?= Foomo\Utils::getServerUrl(false, true) . \Foomo\ROOT_HTTP . '/modules/' . \Foomo\Zugspitze\Module::NAME . '/proxyUpdater.php/Foomo.Zugspitze.ProxyUpdater/getAntBuildFile/' . $model->id ?>"/>
			<arg value="-o"/>
			<arg value="./<?= Foomo\Zugspitze\ProxyUpdater::getAntBuildFileName(); ?>"/>
		</exec>
    </target>
<?php foreach(Foomo\Zugspitze\ProxyUpdater::getServices() as $host => $domainServices): ?>
	<!--  host : <?= $host; ?> <?= \Foomo\Services\Utils::getServiceToolsUrl($host); ?> -->
<?php foreach ($domainServices as $moduleName => $serviceDescriptions):	?>
<?php foreach($serviceDescriptions as $serviceDescription): ?>
	<target name="<?= ucfirst($moduleName) ?> :: <?= ucfirst($serviceDescription->name) ?> - <?= parse_url($serviceDescription->compileAndDownloadUrl, PHP_URL_PATH); ?>" description="<?=$host ?> : <?=$serviceDescription->name ?>">
		<echo message="Generating client source code, compiling it and downloading swc:"/>
		<echo message="Calling: <?php echo \Foomo\Services\Utils::getRemoteServiceUrl($host) . htmlspecialchars($serviceDescription->compileAndDownloadUrl); ?>/<?= $model->id ?>"/>
		<echo message="Please wait..."/>
		<exec executable="/usr/bin/curl">
			<arg value="-k"/>
			<arg value="<?php echo \Foomo\Services\Utils::getRemoteServiceUrl($host) . htmlspecialchars($serviceDescription->compileAndDownloadUrl); ?>/<?= $model->id ?>"/>
			<arg value="-o"/>
			<arg value="../libs/<?= str_replace('\\', '', $serviceDescription->name) . '.swc' ?>"/>
		</exec>
		<echo message="... done."/>
	</target>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
</project>