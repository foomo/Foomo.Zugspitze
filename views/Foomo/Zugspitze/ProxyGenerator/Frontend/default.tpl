<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\ProxyGenerator\Frontend\Model */
// @todo: add service endpoint
\Foomo\HTMLDocument::getInstance()->addJavascripts(array(\Foomo\ROOT_HTTP . '/js/jquery-1.6.1.min.js'));
\Foomo\HTMLDocument::getInstance()->addJavascript("
	$(document).ready(function() {

		$('td.flexSDKLink a').click(function(event){
			event.preventDefault();
			var configId = $('select.flexConfigEntryList').val();
			var url = $(this).attr('href') + '/' + configId;
			window.location.href = url;
		});
	});
");
?>
<h1>Local Services</h1>
Select a configuration entry: <select class="flexConfigEntryList">
<? foreach(\Foomo\Flash\Module::getCompilerConfig()->entries as $entryId => $entry): ?>
	<option value="<?= $entryId ?>"><?= $entry['name'] ?></option>
<? endforeach; ?>
</select>
<table>
<? foreach(\Foomo\Services\Utils::getAllServices() as $moduleName => $serviceUrls): ?>
	<? if(count($serviceUrls) > 0): ?>
		<? $serviceRoot = \Foomo\ROOT_HTTP . '/modules/' . $moduleName . '/services'; ?>
		<tr>
			<td><h2 title="<?= $serviceRoot ?>"><?= $moduleName ?></h2></td>
		</tr>
		<? foreach ($serviceUrls as $serviceUrl): ?>
		<? $fullServiceUrl = 'http://' . $_SERVER['HTTP_HOST'] . $serviceUrl ?>
		<tr>
			<td><?= substr($serviceUrl, strlen($serviceRoot)+1) ?></td>
			<td><?= $view->link('generate', 'generateASClient', array('serviceUrl' => $fullServiceUrl)) ?></td>
			<td><?= $view->link('download tgz', 'getASClientAsTgz', array('serviceUrl' => $fullServiceUrl)) ?></td>
			<td class="flexSDKLink"><?= $view->link('compile', 'compileASClient', array('serviceUrl' => $fullServiceUrl)) ?></td>
			<td class="flexSDKLink"><?= $view->link('download swc', 'getASClientAsSwc', array('serviceUrl' => $fullServiceUrl)) ?></td>
		</tr>
		<? endforeach; ?>
	<? endif; ?>
<? endforeach; ?>
</table>