/*

  !!! DO NOT EDIT THIS FILE / CODE IT WAS GENERATED !!!

  generated @2011-05-16 15:16:52
  on http://radact.interact.com
  THUS, if you this code is missing operations - just regenerate it.

  Oh and if you do not like this code -> fix the generator ;)


*/

(function( window ) {
	// if you do not like "zugspitze.services.scaffold" as a name change,
	// then change the $package parameter for RPC::serveClass()
	window.zugspitze = {};
	window.zugspitze.services = {};
	window.zugspitze.services.scaffold = {
		server: '',
		endPoint: '/foomo/modules/Foomo.Zugspitze/services/scaffold.php/Foomo.Services.RPC/serve',
		/*
			note to self - this is javascript - there is no typing, thus the
			objects may not make sense or should become a json schema ...

		objects: {
			zugspitzeServicesScaffoldLibrary: {
				//
				// string
				id : 'string',
				//
				// string
				name : 'string'
			},
			zugspitzeServicesScaffoldProject: {
				//
				// string
				id : 'string',
				//
				// string
				name : 'string'
			},
			zugspitzeServicesScaffoldApplication: {
				//
				// string
				id : 'string',
				//
				// string
				name : 'string'
			}
		},
		*/
		operations: {
			/**
			  *
			  *
			  *
			  * @return Foomo\Zugspitze\Services\Scaffold\Library[]
			  */
			getLibraries : function() {
				return new this._getLibraries();
			},
			_getLibraries : function() {
				this.data = {
					endPoint: zugspitze.services.scaffold.endPoint,
					arguments: {
					},
					complete: false,
					pending: false,
					result: null,
					exception: null,
					errors: [],
					messages: [],
					ajax: null
				};
				this.execute = function(successCallback) {
					this.successCallback = successCallback;
					var me = this;
					this.data.ajax = $.ajax({
						url: window.zugspitze.services.scaffold.server + this.data.endPoint + '/getLibraries',
						success: function(data) {
							me.data.result = data.value;
							me.data.exception = data.exception;
							me.data.messages = data.messages;
							if(me.data.exception) {
								me._handleError();
							} else {
								me.data.success = true;
								me.successCallback(me);
							}
						},
						error: function(data) {
							me._handleError();
						}

					});
					return this;
				};
				this._handleError = function(){
					this.data.success = false;
					if(this.errorCallback) {
						this.errorCallback(this);
					}
				},
				this.error = function(errorCallback) {
					this.errorCallback = errorCallback;
					return this;
				};
				return this;

			},
			/**
			  *
			  *
			  *
			  * @return Foomo\Zugspitze\Services\Scaffold\Project[]
			  */
			getProjects : function(libraryId) {
				return new this._getProjects(libraryId);
			},
			_getProjects : function(libraryId) {
				this.data = {
					endPoint: zugspitze.services.scaffold.endPoint,
					arguments: {
						libraryId:libraryId
					},
					complete: false,
					pending: false,
					result: null,
					exception: null,
					errors: [],
					messages: [],
					ajax: null
				};
				this.execute = function(successCallback) {
					this.successCallback = successCallback;
					var me = this;
					this.data.ajax = $.ajax({
						url: window.zugspitze.services.scaffold.server + this.data.endPoint + '/getProjects/' + libraryId,
						success: function(data) {
							me.data.result = data.value;
							me.data.exception = data.exception;
							me.data.messages = data.messages;
							if(me.data.exception) {
								me._handleError();
							} else {
								me.data.success = true;
								me.successCallback(me);
							}
						},
						error: function(data) {
							me._handleError();
						}

					});
					return this;
				};
				this._handleError = function(){
					this.data.success = false;
					if(this.errorCallback) {
						this.errorCallback(this);
					}
				},
				this.error = function(errorCallback) {
					this.errorCallback = errorCallback;
					return this;
				};
				return this;

			},
			/**
			  *
			  *
			  *
			  * @return Foomo\Zugspitze\Services\Scaffold\Application[]
			  */
			getApplications : function(projectId) {
				return new this._getApplications(projectId);
			},
			_getApplications : function(projectId) {
				this.data = {
					endPoint: zugspitze.services.scaffold.endPoint,
					arguments: {
						projectId:projectId
					},
					complete: false,
					pending: false,
					result: null,
					exception: null,
					errors: [],
					messages: [],
					ajax: null
				};
				this.execute = function(successCallback) {
					this.successCallback = successCallback;
					var me = this;
					this.data.ajax = $.ajax({
						url: window.zugspitze.services.scaffold.server + this.data.endPoint + '/getApplications/' + projectId,
						success: function(data) {
							me.data.result = data.value;
							me.data.exception = data.exception;
							me.data.messages = data.messages;
							if(me.data.exception) {
								me._handleError();
							} else {
								me.data.success = true;
								me.successCallback(me);
							}
						},
						error: function(data) {
							me._handleError();
						}

					});
					return this;
				};
				this._handleError = function(){
					this.data.success = false;
					if(this.errorCallback) {
						this.errorCallback(this);
					}
				},
				this.error = function(errorCallback) {
					this.errorCallback = errorCallback;
					return this;
				};
				return this;

			}

		}
	};
})(window);

$(document).ready(function() {

	// load library list
	zugspitze.services.scaffold.operations.getLibraries().execute(function(event){
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
		zugspitze.services.scaffold.operations.getProjects(libraryId).execute(function(event){
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

		zugspitze.services.scaffold.operations.getApplications(projectId).execute(function(event){
			input.children().remove();
			input.append($('<option></option>').html('Please select'));
			for (var i in event.data.result) {
				input.append($('<option></option>').val(event.data.result[i].id).html(event.data.result[i].name));
			}
		});
	});
});
