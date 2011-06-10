<?php
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
$services = array_merge(
	array($_SERVER['HTTP_HOST'] => \Foomo\Services\Utils::getAllLocalServiceDescriptions()),
	\Foomo\Services\Utils::getAllRemoteServiceDescriptions()
);
$actionTemplates = array(
	'recompile' => 'antRecompileService.tpl',
	'download' => 'antDownloadService.tpl'
);

?><project name="<?php echo htmlspecialchars($_SERVER['HTTP_HOST']) ?>" basedir=".">
	<!-- generated on <?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?> at <?php echo date('Y-m-d H:i:s'); ?>-->
	<target name="updateMyself" description="update and download the ant file itself">
        <echo message="updating this ant file"/>
		<exec executable="/usr/bin/curl">
			<arg value="-k"/>
			<arg value="<?php echo Foomo\Utils::getServerUrl(false, true) . '/r/modules/zugspitze/serviceProxyUpdater.php?class=zsUpdater&amp;action=getAntFile' ?>"/>
			<arg value="-o"/>
			<arg value="./<?php echo ZSServiceProxyUpdaterModel::getAntFileName(); ?>"/>
		</exec>
    </target>
<?php foreach($services as $host => $domainServices): ?>
	<!--  host : <?php echo $host; ?> <?php echo \Foomo\Services\Utils::getServiceToolsUrl($host); ?> -->
	<?php foreach ($domainServices as $moduleName => $serviceDescriptions):	?>
		<?php foreach($serviceDescriptions as $serviceDescription): ?>
	<target name="<?php echo ucfirst($moduleName) ?><?php echo ucfirst($serviceDescription->name) .  '-' . parse_url($serviceDescription->downloadUrl, PHP_URL_PATH); ?>" description="<?php echo $host ?> : <?php echo $serviceDescription->name ?> at <?php echo parse_url($serviceDescription->downloadUrl, PHP_URL_PATH) ?>">
        <echo message="updating and downloading"/>
		<?php
		        $view->includePhp('antRecompileService.tpl', array('serviceDescription' => $serviceDescription, 'host' => $host));
        		$view->includePhp('antDownloadService.tpl', array('serviceDescription' => $serviceDescription, 'host' => $host));
        ?>
    </target>
    	<?php endforeach; ?>
	<?php endforeach; ?>
<?php endforeach; ?>
</project>
