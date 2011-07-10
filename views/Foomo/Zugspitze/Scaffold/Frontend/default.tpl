<?
/* @var $view Foomo\MVC\View */
?>
<h2>Zugspitze Project Scaffolding</h2>

<div id="ZSFormContainer">

	<form id="zugspitze-scaffolding-form" method="POST" action="<?= $view->url('generateApplication') ?>">
		<div class="greyBox">

			<div class="formBox">
				<div class="formTitle">Select library</div>
				<select id="zugspitze-scaffolding-form-libraries" name="libraryProjectId"></select>
			</div>

			<div class="formBox">
				<div class="formTitle">Select Project</div>
				<select id="zugspitze-scaffolding-form-projects" name="implementationProjectId"></select>
			</div>

			<div class="formBox">
				<div class="formTitle">Select application</div>
				<select id="zugspitze-scaffolding-form-applications" name="implementationProjectApplicationId"></select>
			</div>

			<div class="formBox">
				<div class="formTitle">Package name (i.e. com.bestbytes.yourApplication)</div>
				<input id="packageInput" type="text" name="packageName" value="" size="50" />
			</div>

			<div class="formBox">
				<input type="submit" value="generate" class="submitButton">
			</div>
		</div>

	</form>

</div>
