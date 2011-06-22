<h2>Zugspitze Project Scaffolding</h2>

<div id="ZSFormContainer">

	<form id="zugspitze-scaffolding-form" method="POST" action="<?= $view->url('generate') ?>">

		<div>
			<h3>Select library</h3>
			<select id="zugspitze-scaffolding-form-libraries" name="libraryId"></select>
		</div>

		<div>
			<h3>Select Project</h3>
			<select id="zugspitze-scaffolding-form-projects" name="projectId"></select>
		</div>

		<div>
			<h3>Select application</h3>
			<select id="zugspitze-scaffolding-form-applications" name="applicationId"></select>
		</div>

		<div>
			<h3>Package name (i.e. com.bestbytes.yourApplication)</h3>
			<input id="packageInput" type="text" name="package" value="" size="50" /><br>
		</div>


		<p><input type="submit" value="generate"></p>

	</form>

</div>
