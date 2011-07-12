<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\ProxyGenerator\Frontend\Model */
\Foomo\HTMLDocument::getInstance()->addJavascripts(array(\Foomo\ROOT_HTTP . '/js/jquery-1.6.1.min.js'));
\Foomo\HTMLDocument::getInstance()->addJavascript("
	$(document).ready(function() {

		$('a.flexSDKLink').click(function(event){
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
		<? foreach($model->services as $moduleName => $descriptions): ?>
			<? $serviceRoot = \Foomo\Utils::getServerUrl() . \Foomo\ROOT_HTTP . '/modules/' . $moduleName . '/services'; ?>
			<tr>
				<td colspan="5"><h2><?= $moduleName ?></h2></td>
			</tr>
			<? foreach ($descriptions as $description): ?>
				<tr>
					<td><a href="<?= $description->documentationUrl ?>" target="_blank"><?= substr($description->url, strlen($serviceRoot)+1) ?></a></td>
					<td><?= $view->link('generate', 'generateASClient', array('serviceUrl' => $description->url), array('class' => 'overlay')) ?></td>
					<td><?= $view->link('download tgz', 'getASClientAsTgz', array('serviceUrl' => $description->url)) ?></td>
					<td><?= $view->link('compile', 'compileASClient', array('serviceUrl' => $description->url), array('class' => 'flexSDKLink overlay')) ?></td>
					<td><?= $view->link('download swc', 'getASClientAsSwc', array('serviceUrl' => $description->url), array('class' => 'flexSDKLink')) ?></td>
				</tr>
			<? endforeach; ?>
		<? endforeach; ?>
	</table>
	<div class="innerBox" >
		<?= $view->link('Download Ant Build File', 'getAntBuildFile', array(), array('class' => 'flexSDKLink linkButtonYellow')); ?><br>
		<br>
	</div>
</div>