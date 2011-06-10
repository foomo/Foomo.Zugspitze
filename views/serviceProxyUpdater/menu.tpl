<?php
$services = array_merge( array($_SERVER['HTTP_HOST'] => \Foomo\Services\Utils::getAllLocalServiceDescriptions()), \Foomo\Services\Utils::getAllRemoteServiceDescriptions());
?><h1>Service proxy updater</h1>
<h2>
	<a 
		title="this ant file contains build targets for all available services"
		href="<?php echo \Foomo\MVC\ControllerHelper::staticRenderAppLink('ZSServiceProxyUpdaterController', 'actionGetAntFile') ?>">
		download ANT build file
	</a>
</h2>
<h3>Servers and their services</h3>
<table>
<?php foreach($services as $host => $domainServices): ?>
	<tr>
		<td colspan="5">
			<a title="visit toolbox/services on that server" target="_services<?php echo ucfirst($host); ?>" href="<?php echo \Foomo\Services\Utils::getServiceToolsUrl($host); ?>">
				host : <?php echo $host; ?>
			</a>
			<?php
				/* @var $firstDescription ServiceDescription */
				$compilerAvailable = false;
				foreach($domainServices as $ds) {
					if(count($ds)>0) {
						if($ds[0]->compilerAvailable) {
							$compilerAvailable = true;
							break;
						}
					}
				}
				if($compilerAvailable) {
					echo ' - compiler available';
				} else {
					echo ' - compiler and client downloads are not available';
				}
			 ?>
		</td>
	</tr>
	<?php foreach ($domainServices as $domain => $serviceDescriptions): ?>
		<?php if(count($serviceDescriptions) > 0): ?>
	<tr>
		<td>&nbsp;</td>
		<td colspan="4"><?php echo $domain ?> services</td>
	</tr>
			<?php if(count($serviceDescriptions)>0): ?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>name</td>
		<td>type</td>
		<td>version</td>
		<td>location</td>
	</tr>
				<?php foreach($serviceDescriptions as $serviceDescription):  ?>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $serviceDescription->name; ?></td>
		<td><?php echo $serviceDescription->type; ?></td>
		<td><?php echo $serviceDescription->version; ?></td>
		<td><a href="<?php echo \Foomo\Services\Utils::getRemoteServiceUrl($host) . htmlspecialchars($serviceDescription->documentationUrl) ?>"><?php echo parse_url($serviceDescription->documentationUrl, PHP_URL_PATH); ?></a></td>
	</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endforeach; ?>
</table>
