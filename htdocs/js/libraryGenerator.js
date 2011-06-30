$(document).ready(function() {

	var downloadSwcAction = $('#zugspitze-library-form').attr('actionDownloadSwc');
	var downloadAntAction = $('#zugspitze-library-form').attr('actionDownloadAnt');

	$('#download-swc-button').click(function(event) {
		event.preventDefault();
		var configId = $('select.flexConfigEntryList').val();
		var url = downloadSwcAction + '/' + configId;
		$('#zugspitze-library-form').attr('action', url);
		$('#zugspitze-library-form').submit();
	});

	$('#download-ant-button').click(function(event) {
		event.preventDefault();
		var configId = $('select.flexConfigEntryList').val();
		var url = downloadAntAction + '/' + configId;
		$('#zugspitze-library-form').attr('action', url);
		$('#zugspitze-library-form').submit();
	});

	$('select.libraryConfigPresetList').change(function(event) {
		var select = $(this);
		selectLibraryProjects(select.val().split(','));
		updateDependencies();
	});

	$('#zugspitze-library-form input.libraryProject').change(function(index, value) {
		updateDependencies();
		updatePresetList();
	});

	function updateDependencies() {
		var dependencies = [];
		$('#zugspitze-library-form input.libraryProject:checked').each(function(index, value) {
			dependencies = dependencies.concat($(value).attr('dependencies').split(','));
		});
		array_unique(dependencies);

		$('#zugspitze-library-form input.libraryProject').each(function(index, value) {
			var input = $(this);
			var dependend = (jQuery.inArray(input.attr('value'), dependencies) >= 0);
			if (dependend) input.prop('checked', dependend);
			input.attr('readonly', (dependend) ? 'true' : '');
			input.css('opacity', (dependend) ? 0.5 : 1);
		});
	}

	function updatePresetList() {
		var selectedLibraryConfigIds = [];

		$('#zugspitze-library-form input.libraryProject:checked').each(function(index, value) {
			selectedLibraryConfigIds.push($(value).attr('value'));
		});

		var found = false;
		$('select.libraryConfigPresetList option').each(function(index, value) {
			var inputValue = $(value).attr('value');
			if ($(inputValue.split(',')).compare(selectedLibraryConfigIds)) {
				$('select.libraryConfigPresetList').val(inputValue);
				found = true;
			}
		});

		if (!found) $('select.libraryConfigPresetList').val('');
	}

	function selectLibraryProjects(libraryProjectIds) {
		$('#zugspitze-library-form input.libraryProject').each(function(index, value){
			var input = $(value);
			input.prop('checked', (jQuery.inArray(input.attr('value'), libraryProjectIds) >= 0));
		});
	}

	jQuery.fn.compare = function(t) {
		if (this.length != t.length) {return false;}
		var a = this.sort(),
			b = t.sort();
		for (var i = 0; t[i]; i++) {
			if (a[i] !== b[i]) {
					return false;
			}
		}
		return true;
	};

	function array_unique(ar) {
		if(ar.length && typeof ar!=='string'){
			var sorter = {};
			var out = [];
			for(var i=0,j=ar.length;i<j;i++){
			if(!sorter[ar[i]+typeof ar[i]]){
				out.push(ar[i]);
				sorter[ar[i]+typeof ar[i]]=true;
			}
		}
	}
	return out || ar;
	}

	updateDependencies();
});
