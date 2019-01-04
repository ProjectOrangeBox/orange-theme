/*
<form action="/post.php" method="post"...

data-confirm="heading|body|icon|cancel|ok"
data-primary_id="id" - default id
data-success="Text|style|(bool)stay" - stay defaults to false 
data-redirect="/url" - redirect to this url on success
data-fadeout="tr" - closest element to fade out on success

...>

*/
/* create our empty classes */
var orange = (orange) || {};

orange.dialog = (orange.dialog) || {};

/* handler for the submit button click */
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

		/* show the dialog */
		orange.dialog.show(icon,heading,body,cancel,ok);
	} else {
		/* no dialog to show so just call the "continue" callback */
		orange.dialog.confirm_ok(e,that);
	}
}

/* when Form Ajax Fails Hard */
orange.dialog.request_fail = function() {
	/* pop up a fail message */
	orange.flash_msg('Action Failed','red',false);
}

orange.get_length = function(object,only) {
	if (only) {
		if (object.hasOwnProperty(only)) {
			return object[only].length > 0;
		}
		
		return 0;
	}
		
	/* all */
	var total = 0;
	
	for (var prop in object) {
		if (object.hasOwnProperty(prop)) {
			total = total + object[prop].length;
		}
	}
	
	return total;
}

orange.get_errors = function(object,lineending,only) {
	/* only */
	if (only) {
		if (object.hasOwnProperty(only)) {
			if (object[only].length > 0) {
				return object[only].join(lineending);
			}
		}
		
		return '';
	}
	
	/* all */
	var groups = [];

	for (var prop in object) {
		if (object.hasOwnProperty(prop)) {
			if (object[prop].length > 0) {
				groups.push(object[prop].join(lineending));
			}
		}
	}

	return groups.join(lineending);
}

/*when Form Ajax Success - but could have errors */
orange.dialog.request_done = function(reply) {
	/* hide all of the notices */
	$.noticeRemoveAll();

	var total_errors = orange.get_length(reply.ci_errors,orange.form.errors_for);

	/* show any errors */
	if (total_errors > 0) {
		$.noticeAdd({text: orange.get_errors(reply.ci_errors,'<br>',orange.form.errors_for), type: 'danger', stay: true});
	} else {
		/* no errors so continue with work */

		/* is fadeout set for this action highlight it "info" color for a split second until it get's lower in the code */
		if (orange.that.closest(orange.form_obj.data('fadeout'))) {
			orange.that.closest(orange.form_obj.data('fadeout')).addClass('info');
		}

		/*
		don't forget to merge the primary key hidden on the details form with the returned value from a insert
		get the primary key from the stored value on the form or default to id
		*/
		var primary_input_field_name = (orange.form_obj.data('primary_id')) ? orange.form_obj.data('primary_id') : 'id';

		/* did the responds have a primary key value? if so put that as the value */
		if (reply.primary_key) {
			$('input[name='+primary_input_field_name+']').val(reply.primary_key);
		}

		/* data-success="message|style" */
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

		/* now fade it out */
		if (orange.that.closest(orange.form_obj.data('fadeout'))) {
			orange.that.closest(orange.form_obj.data('fadeout')).fadeOut();
		}

		/* redirect if a redirect exists */
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

/* dialog confirm button or form submit */
orange.dialog.confirm_ok = function() {
	console.log(orange.form_obj.attr('action'));
	
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

/* main form submit button */
$('.js-button-submit').on('click',function(e) {
	orange.dialog.button_submit_click(e,this);
});

/* generic form submit */
orange.form = {};

/* set this to only show errors from 1 error group */
if (!orange.form.errors_for) {
	orange.form.errors_for = false;
}

orange.form.success = function(reply) {
	var success = true;
	
	/* hide all of the notices */
	$.noticeRemoveAll();

	var total_errors = orange.get_length(reply.ci_errors,orange.form.errors_for);

	/* show any errors */
	if (total_errors > 0) {
		$.noticeAdd({text: orange.get_errors(reply.ci_errors,'<br>',orange.form.errors_for), type: 'danger', stay: true});
		
		success = false;
	}
	
	return success;
}

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
			var success = orange.form.success(reply);
			
			orange.form.request_done(reply,success);
		}
	})
} /* end orange.form.submit */
