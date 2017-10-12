$('body').append('<div id="o_dialog" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div style="width:40px;display:inline-block"><i class="fa fa-2x"></i></div><div style="display:inline-block"><h4 class="modal-title heading"></h4><span class="body"></span></div></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <button type="button" class="btn btn-primary">Ok</button></div></div></div></div>');

var orange = (orange) || {};

orange.dialog = (orange.dialog) || {};

/*
orange.dialog.show('user','Edit User','Are you sure your want to edit the user?','Cancel','Ok');
*/

orange.dialog.show = function(icon,heading,text,cancel,ok) {
	/* remove all orange notices */
	if (typeof $.noticeRemoveAll != "undefined") {
		$.noticeRemoveAll();
	}

	/* populate the dialog */
	$('#o_dialog i.fa').addClass('fa-' + icon);
	$('#o_dialog .heading').html(heading);
	$('#o_dialog span.body').html(text);
	$('#o_dialog button.btn-default').html(cancel);
	$('#o_dialog button.btn-primary').html(ok);

	/* show the dialog */
	$('#o_dialog').modal('show');
}

/* if you click on the dialogs primary action button */
$(document).on('click', '#o_dialog .btn-primary', function(e) {
	/* prevent any default action from happening */
	e.preventDefault();

	/* close the dialog */
	$('#o_dialog').modal('hide');

	/*
	call the primary button click action/callback
	this can be overridden to preform another action besides the default
	*/
	orange.dialog.confirm_ok(e,this);
});

/* NOTE: close works by default via bootstrap js code */