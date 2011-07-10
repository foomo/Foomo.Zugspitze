<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\ProxyGenerator\Frontend\Model */
// @todo: add service endpoint
\Foomo\HTMLDocument::getInstance()->addJavascripts(array(\Foomo\ROOT_HTTP . '/js/jquery-1.6.1.min.js'));
\Foomo\HTMLDocument::getInstance()->addJavascript("
	$(document).ready(function() {

		$('a').click(function(event){
			event.preventDefault();
			var configId = $('select.flexConfigEntryList').val();
			var url = $(this).attr('href') + '/' + configId;
			window.location.href = url;
		});
	});
");
?>
<h2>Local Services</h2>

<div class="greyBox">

	<div class="formBox">
		<div class="formTitle">Select a configuration entry</div>
		<select class="flexConfigEntryList">
		<? foreach(\Foomo\Flash\Module::getCompilerConfig()->entries as $entryId => $entry): ?>
			<option value="<?= $entryId ?>"><?= $entry['name'] ?></option>
		<? endforeach; ?>
		</select>
	</div>
<table>
<? foreach(\Foomo\Services\Utils::getAllServices() as $moduleName => $serviceUrls): ?>
	<? if (count($serviceUrls) > 0): ?>
		<? $serviceRoot = \Foomo\ROOT_HTTP . '/modules/' . $moduleName . '/services'; ?>
		<tr>
			<td><h2 title="<?= $serviceRoot ?>"><?= $moduleName ?></h2></td>
		</tr>
		<? foreach ($serviceUrls as $serviceUrl): ?>
		<? $fullServiceUrl = 'http://' . $_SERVER['HTTP_HOST'] . $serviceUrl ?>
		<tr>
			<td><?= substr($serviceUrl, strlen($serviceRoot)+1) ?></td>
			<td><?= $view->link('generate', 'generateASClient', array('serviceUrl' => $fullServiceUrl), array('class' => 'overlay')) ?></td>
			<td><?= $view->link('download tgz', 'getASClientAsTgz', array('serviceUrl' => $fullServiceUrl)) ?></td>
			<td><?= $view->link('compile', 'compileASClient', array('serviceUrl' => $fullServiceUrl), array('class' => 'flexSDKLink overlay')) ?></td>
			<td><?= $view->link('download swc', 'getASClientAsSwc', array('serviceUrl' => $fullServiceUrl)) ?></td>
		</tr>
		<? endforeach; ?>
	<? endif; ?>
<? endforeach; ?>
</table>
	<div class="innerBox" >
		<?= $view->link('Download Ant Build File', 'getAntBuildFile', array(), array('class' => 'flexSDKLink linkButtonYellow')); ?><br>
		<br>
	</div>
</div>