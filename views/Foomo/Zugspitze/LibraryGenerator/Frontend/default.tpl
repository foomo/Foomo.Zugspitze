<?php
/* @var $view Foomo\MVC\View */
/* @var $model Foomo\Zugspitze\LibraryGenerator\Frontend\Model */
/* @var $libraryProject Foomo\Zugspitze\Vendor\Sources\Project */
?>
<h2>Zugspitze Library Generator</h2>

Select a configuration entry: <select class="flexConfigEntryList">
<? foreach(\Foomo\Flex\DomainConfig::getInstance()->entries as $entryId => $entry): ?>
	<option value="<?= $entryId ?>"><?= $entry['name'] ?></option>
<? endforeach; ?>
</select>

<br><br>

Select a configuration preset: <select class="libraryConfigPresetList">
	<option value="">User defined</option>
<? foreach($model->presets as $entryId => $entry): ?>
	<option value="<?= implode(',', $entry['projectLibraryIds']) ?>"><?= $entry['name'] ?></option>
<? endforeach; ?>
</select>

<form id="zugspitze-library-form" method="POST" action="<?= $view->url('compileLibrary') ?>">
	<table>
		<thead>
			<tr>
				<td>Name</td>
				<td>Description</td>
				<td>Dependencies</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
<? foreach($model->libraryProjects as $libraryProject): ?>
			<tr>
				<td><?= $view->escape($libraryProject->name) ?></td>
				<td><?= $view->escape($libraryProject->description) ?></td>
				<td><?= $view->escape(implode(', ', $libraryProject->dependencies)) ?></td>
				<td><input class="libraryProject" value="<?= $libraryProject->id ?>" name="projectLibraryIds[]" type="checkbox"></input></td>
			</tr>
<? endforeach; ?>
		</tbody>
	</table>

	<p><input type="submit" value="generate"></p>

</form>
