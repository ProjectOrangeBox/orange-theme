/**
 *
 * <form action="/post.php" method="post"...
 *
 * data-confirm="heading|body|icon|cancel|ok"
 *		show a confirm dialog with the provided options before allowing the form to submit
 *		pipe separated
 *
 * data-primary_id="id" - default id
 *		This is the form element name of the primary id <input name="id" value="...
 *		This defaults to "id" but some models have "md5" or something else as the primary id
 * 		When this is set the input field is filled with the primary id returned from POST (insert) to make it a PATCH (update)
 *
 * data-success="Text|style|(bool)stay" - stay defaults to false
 *		on success
 *			Text to display in dialog
 *			dialog style
 *			should the dialog stay up
 *			pipe separated
 *			(note if redirect is included then this is stored and shown on the next page)
 *
 * data-redirect="/url"
 *		redirect to this url on success
 *		if this is "action" redirect to the forms action attribute value
 *
 * data-fadeout="tr"
 *		closest element to fade out on success
 *
 * ...>
 *
 *
 * if the page include the variable
 * 		orange_form_error_group = 'foobar';
 * 		orange_form_error_group = ['modelb','modela'];
 *
 * then rest form library will only listen to errors from those error groups (usually models)
 *
 */

/*
 * setup the objects if they don't already exist
 */
var orange = (orange) || {};

var orange_form_error_group = (orange_form_error_group) || false;

orange.dialog = (orange.dialog) || {};
orange.form = orange.form || {};

/**
 *
 * handler for the submit button click
 *
 */
orange.dialog.button_submit_click = function(e,that) {
	/* prevent the default action */
	e.preventDefault();

	/*save a copy of "this" */
	orange.that = $(that);

	/* travel up from the submit button and find the closest <form> */
	orange.form_obj = orange.that.closest('form');

	/* is a confirm data attribute on the form element? */
	if (orange.form_obj.data('confirm')) {
		/* these are a pipe separated list  (seemed the easiest - note the order) */
		var parts = (orange.form_obj.data('confirm') != true) ? orange.form_obj.data('confirm').split("|") : '';

		var heading = (parts[0]) ? parts[0] : 'Are you sure?';
		var body    = (parts[1]) ? parts[1] : '';
		var icon    = (parts[2]) ? parts[2] : 'exclamation-triangle';
		var cancel  = (parts[3]) ? parts[3] : 'Cancel';
		var ok      = (parts[4]) ? parts[4] : 'Ok';

		/* show the confirm dialog */
		orange.dialog.show(icon,heading,body,cancel,ok);
	} else {
		/* no dialog to show so just call the confirm dialogs "continue" button callback */
		orange.dialog.confirm_ok(e,that);
	}
}

/**
 *
 * when Form Ajax Fails Hard
 *
 */
orange.dialog.request_fail = function() {
	/* pop up a fail message */
	orange.flash_msg('Action Failed','red',false);
}

/**
 *
 * when Form Ajax Success - but could have errors
 *
 */
orange.dialog.request_done = function(reply) {
	/* hide all of the notices */
	$.noticeRemoveAll();

	/* show any errors */
	if (orange.form.has_error(reply.ci_errors)) {
		var errors_as_array = orange.form.get_errors(reply.ci_errors);

		for (var i in errors_as_array) {
			$.noticeAdd({text: errors_as_array[i], type: 'danger', stay: true});
		}
	} else {
		/* no errors so continue with work */

		/**
		 *
		 * is fadeout set for this action highlight in the "info" color
		 * for a split second until we get lower in the code  where we fade it out
		 *
		 */
		if (orange.that.closest(orange.form_obj.data('fadeout'))) {
			orange.that.closest(orange.form_obj.data('fadeout')).addClass('info');
		}

		/**
		 *
		 * don't forget to merge the primary key hidden on the details form with the returned value from a insert
		 * get the primary key from the stored value on the form or default to id
		 *
		 */
		var primary_input_field_name = (orange.form_obj.data('primary_id')) ? orange.form_obj.data('primary_id') : 'id';

		/**
		 *
		 * did the responds have a primary key value? if so put that as the value
		 *
		 */
		if (reply.primary_key) {
			$('input[name='+primary_input_field_name+']').val(reply.primary_key);
		}

		/**
		 *
		 * does the form have a data-success attribute
		 * data-success="message|style|[false|action]"
		 *
		 */
		if (orange.form_obj.data('success')) {
			var parts = orange.form_obj.data('success').split("|");

			/* does redirect contain something? if it does than save msg in browser local storage */
			var redirect = (orange.form_obj.data('redirect')) ? true : ((parts[2] === 'false') ? false : orange.form_obj.attr('action'));

			orange.flash_msg(parts[0],parts[1],redirect);

			/* switch post (insert) to patch (update) now */
			if (orange.form_obj.attr('method').toLowerCase() == 'post') {
				orange.form_obj.attr('method','PATCH')
			}
		}

	/**
	 *
	 * now fade out closet JQuery selector if data-fadeout="" is set
	 * of course if you are redirecting this doesn't matter
	 *
	 */
	if (orange.that.closest(orange.form_obj.data('fadeout'))) {
			orange.that.closest(orange.form_obj.data('fadeout')).fadeOut();
		}

	/**
	 *
	 * redirect if a redirect exists
	 *
	 * options include a URL or "action" which redirect to the forms action attribute value.
	 *
	 */
		if (orange.form_obj.data('redirect')) {
			/* <form data-redirect=""> */
			var redirect = orange.form_obj.data('redirect');

			if (redirect == 'action') {
				redirect = orange.form_obj.attr('action');
			}

			orange.redirect(redirect);
		}

	}
}

/**
 *
 * dialog confirm button or form submit
 *
 */
orange.dialog.confirm_ok = function() {
	orange.dialog.request = $.ajax({
		method: orange.form_obj.attr('method'),
		url: orange.form_obj.attr('action'),
		data: orange.form_obj.serializeArray(),
		dataType: 'json',
		cache: false,
		timeout: 5000,
		async: true
	});

	orange.dialog.request.fail(function() {
		/* defined above and can be overridden */
		orange.dialog.request_fail();
	});

	orange.dialog.request.done(function(reply) {
		if (reply === undefined) {
			/* beats me what happened? Show a flash msg. */
			orange.flash_msg('Unknown Reply','yellow',false);
		} else {
			/* it's all good call the function */
			/* defined above and can be overridden */
			orange.dialog.request_done(reply);
		}
	})
}

/**
 *
 * main form submit button
 *
 */
$('.js-button-submit').on('click',function(e) {
	orange.dialog.button_submit_click(e,this);
});

/**
 *
 * generic form submit
 * these can be overwritten on the page to provide other actions
 *
 */

orange.form.success = function(reply) {
	var success = true;

	/* hide all of the notices */
	$.noticeRemoveAll();

	/* show any errors */
	if (orange.form.has_error(reply.ci_errors)) {
		var errors_as_array = orange.form.get_errors(reply.ci_errors);

		for (var i in errors_as_array) {
			$.noticeAdd({text: errors_as_array[i], type: 'danger', stay: true});
		}

		success = false;
	}

	return success;
} /* end orange.form.success */

orange.form.request_done = function(reply,success){}; /* place holder for user to extend as needed */

orange.form.submit = function(method,url,data) {
	orange.form.request = $.ajax({
		method: method,
		url: url,
		data: data,
		dataType: 'json',
		cache: false,
		timeout: 5000,
		async: true
	});

	orange.form.request.fail(function() {
		/* defined above and can be overridden */
		orange.dialog.request_fail();
	});

	orange.form.request.done(function(reply) {
		if (reply === undefined) {
			/* beats me what happened? Show a flash msg. */
			orange.flash_msg('Unknown Reply','yellow',false);
		} else {
			orange.form.request_done(reply,orange.form.success(reply));
		}
	})
} /* end orange.form.submit */

orange.form.has_error = function(errors,from) {
	return (orange.form.get_errors(errors,from,'').length != 0);
}

orange.form.get_errors = function(errors,from,join_with) {
	var array = [];
	var from_matched = false;

	/* only count and build from these error groups - if provided */
	if (orange_form_error_group) {
		from = orange_form_error_group;
	}

	/* return all error groups */
	if (from == undefined) {
		from_matched = true;
		for (var property in errors) {
			if (errors.hasOwnProperty(property)) {
				if (group = orange.form.get_error(errors,property,join_with)) {
					array.push(group);
				}
			}
		}
	}

	/* only return the error groups in this array */
	if (Array.isArray(from)) {
		from_matched = true;
		for (var grouping in from) {
			if (group = orange.form.get_error(errors,grouping,join_with)) {
				array.push(group);
			}
		}
	}

	/* only return the error group in this string */
	if (from_matched == false) {
		/* single string */
		if (group = orange.form.get_error(errors,from,join_with)) {
			array.push(group);
		}
	}

	return array;
}

orange.form.get_error = function(errors,property,join_with) {
	join_with = (join_with) || '<br>';

	var group = false;

	if (errors[property]) {
		var g = [];
		for (var key in errors[property]) {
			g.push(errors[property][key]);
		}
		if (g.length > 0) {
			group = g.join(join_with);
		}
	}

	return group;
}
