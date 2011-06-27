<?
/* @var $view Foomo\MVC\View */
?>
<h2>Zugspitze Project Scaffolding</h2>

<div id="ZSFormContainer">

	<form id="zugspitze-scaffolding-form" method="POST" action="<?= $view->url('generateApplication') ?>">

		<div>
			<h3>Select library</h3>
			<select id="zugspitze-scaffolding-form-libraries" name="libraryProjectId"></select>
		</div>

		<div>
			<h3>Select Project</h3>
			<select id="zugspitze-scaffolding-form-projects" name="implementationProjectId"></select>
		</div>

		<div>
			<h3>Select application</h3>
			<select id="zugspitze-scaffolding-form-applications" name="implementationProjectApplicationId"></select>
		</div>

		<div>
			<h3>Package name (i.e. com.bestbytes.yourApplication)</h3>
			<input id="packageInput" type="text" name="packageName" value="" size="50" /><br>
		</div>


		<p><input type="submit" value="generate"></p>

	</form>

</div>
