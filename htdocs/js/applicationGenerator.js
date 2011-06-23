$(document).ready(function() {

	// load library list
	Foomo.Zugspitze.Services.Scaffold.operations.getLibraries().execute(function(event){
		var input = $('#zugspitze-scaffolding-form-libraries');
		input.children().remove();
		input.append($('<option></option>').html('Please select'));
		for (var i in event.data.result) {
			input.append($('<option></option>').val(event.data.result[i].id).html(event.data.result[i].name));
		}
	});

	// load library's project list
	$('#zugspitze-scaffolding-form-libraries').change(function() {
		var input = $('#zugspitze-scaffolding-form-projects');
		var libraryId = $('#zugspitze-scaffolding-form-libraries option:selected').val();
		Foomo.Zugspitze.Services.Scaffold.operations.getProjects(libraryId).execute(function(event){
			input.children().remove();
			input.append($('<option></option>').html('Please select'));
			for (var i in event.data.result) {
				input.append($('<option></option>').val(event.data.result[i].id).html(event.data.result[i].name));
			}
		});
	});

	// load project's application list
	$('#zugspitze-scaffolding-form-projects').change(function() {
		var input = $('#zugspitze-scaffolding-form-applications');
		var projectId = $('#zugspitze-scaffolding-form-projects option:selected').val();

		Foomo.Zugspitze.Services.Scaffold.operations.getApplications(projectId).execute(function(event){
			input.children().remove();
			input.append($('<option></option>').html('Please select'));
			for (var i in event.data.result) {
				input.append($('<option></option>').val(event.data.result[i].id).html(event.data.result[i].name));
			}
		});
	});
});
