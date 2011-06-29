<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\ProxyUpdater\Frontend\Model */
/* @var $serviceDescription Foomo\Services\ServiceDescription */
\Foomo\HTMLDocument::getInstance()->addJavascripts(array(\Foomo\ROOT_HTTP . '/js/jquery-1.6.1.min.js'));
\Foomo\HTMLDocument::getInstance()->addJavascript("
	$(document).ready(function() {

		$('a.flexSDKLlink').click(function(event){
			event.preventDefault();
			var configId = $('select.flexConfigEntryList').val();
			var url = $(this).attr('href') + '/' + configId;
			window.location.href = url;
		});
	});
");
?>
<h2>Service proxy updater</h2>


Select a configuration entry: <select class="flexConfigEntryList">
<? foreach(\Foomo\Flash\Module::getCompilerConfig()->entries as $entryId => $entry): ?>
	<option value="<?= $entryId ?>"><?= $entry['name'] ?></option>
<? endforeach; ?>
</select>
<h3><a class="flexSDKLlink" title="this ant file contains build targets for all available services" href="<?= $view->url('actionGetAntBuildFile') ?>">download ANT build file</a></h3>
<h3>Available services</h3>
<table>
	<?php foreach (Foomo\Zugspitze\ProxyUpdater::getServices() as $host => $domainServices): ?>
		<tr>
			<td colspan="5">
				<a title="visit toolbox/services on that server" target="_services<?php echo ucfirst($host); ?>" href="<?php echo \Foomo\Services\Utils::getServiceToolsUrl($host); ?>">host : <?php echo $host; ?></a>
				<?php
					$compilerAvailable = false;
					foreach($domainServices as $ds) {
						if(count($ds)>0) {
							if($ds[0]->compilerAvailable) {
								$compilerAvailable = true;
								break;
							}
						}
					}
					echo ($compilerAvailable) ? ' - compiler available' : ' - compiler and client downloads are not available';
				 ?>
			</td>
		</tr>
		<?php foreach ($domainServices as $domain => $serviceDescriptions): ?>
			<?php if(count($serviceDescriptions) > 0): ?>
				<tr>
					<td>&nbsp;</td>
					<td colspan="4"><?php echo $domain ?> services</td>
				</tr>
					<?php if (count($serviceDescriptions) > 0): ?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>name</td>
							<td>version</td>
							<td>location</td>
						</tr>
						<?php foreach($serviceDescriptions as $serviceDescription):  ?>
						<? if ($serviceDescription->type != \Foomo\Services\ServiceDescription::TYPE_RPC_AMF) continue; ?>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><?php echo $serviceDescription->name; ?></td>
								<td><?php echo $serviceDescription->version; ?></td>
								<td><a href="<?php echo \Foomo\Services\Utils::getRemoteServiceUrl($host) . htmlspecialchars($serviceDescription->documentationUrl) ?>"><?php echo parse_url($serviceDescription->documentationUrl, PHP_URL_PATH); ?></a></td>
							</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endforeach; ?>
</table>
