/* https://blikblum.github.io/tinybind/ */

/* json model is also bound to this */
var app = {
	error: false, /* do we have an error - boolean true/false */
	errors: {}, /* "errors":{"robots":{"Name":"Name is required.","Year":"Year is required."}}} */
	record: {}, /* single record */
	records: [], /* array of single records */
	page: {}, /* page variables */
	form: {}, /* form variables */
	events: {}, /* events are attached to this */
	isattached: false,
	init() {
		/* retrieve the model */
		var handlers = {
			200: function(response) {
				/* app is global */
				app = Object.assign(app,response);

				/* now let's bind it */
				if (!app.isattached) {
					/* we only bind once! every thing else we just change app object directly */
					tinybind.bind(jQuery('#app'),app);
					app.isattached = true;
				}

				$(document).trigger('orange_table_updated');
			},
		}

		var appObject = jQuery('#app');

		if (appObject) {
			orangejax('get',appObject.data('url'),{},handlers);
		}
	},
	events: {
		goback(event) {
			/* do nothing special */
			//event.preventDefault();
		},
		create(event) {
			/* do nothing special */
			//event.preventDefault();
		},
		delete(event) {
			var element = $(this);
			event.preventDefault();

			/**
			 * if result is true then they pressed ok
			 * if result is false then they pressed cancel
			 */
			bootbox.confirm('Are you sure?',function(okButton) {
				if (okButton) {
					var handlers = {
						202: function(data) {
							element.closest('tr').remove();
						}
					};

					orangejax('delete',element.attr('href'),{},handlers);
				}
			});
		},
		edit(event) {
			/* do nothing special */
			//event.preventDefault();
		},
		submit(event) {
			event.preventDefault();

			var send = {};

			send.error = app.error;
			send.errors = app.errors;
			send.record = app.record;
			send.records = app.records;
			send.page = app.page;
			send.form = app.form;

			var handlers = {
				/* 201 Created */
				201: function(data,textStatus,jqXHR) {
					app = Object.assign(app,data);
					window.location.replace(app.path);
				},
				/* 202 Accepted */
				202: function(data,textStatus,jqXHR) {
					app = Object.assign(app,data);
					window.location.replace(app.page.path);
				},
				406: function(jqXHR,textStatus,errorThrown) {
					app = Object.assign(app,jqXHR.responseJSON);

					if (app.error) {
						notify.removeAll();
						for (const key in app.errors) {
							for (const key2 in app.errors[key]) {
								notify.addError(app.errors[key][key2]);
							}
						}
					}
				},
			}

			orangejax(app.form.method,app.form.action,send,handlers);
		}
	}
};

document.addEventListener('DOMContentLoaded',function(){
	app.init();
});
