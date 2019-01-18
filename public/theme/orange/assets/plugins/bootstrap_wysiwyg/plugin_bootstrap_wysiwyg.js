/**
 * 
 * https://developer.mozilla.org/en-US/docs/Rich-Text_Editing_in_Mozilla#Executing_Commands
 * http://github.com/mindmup/bootstrap-wysiwyg
 *
 * Used in conjunction with pear::bootstrap_wysiwyg($name,$value,$extra)
 * 
 * extra['height'] in pixels
 * extra['toolbar'] must be available in PHP searchable paths ../libraries/plugins/bootstrap_wysiwyg_toolbars/*
 *
 */

/* add the source code modal to the page */
$('body').append('<div id="wysiwyg-source-modal" style="" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><p id="wysiwyg-source-modal-body">x</p></div><div class="modal-footer"><button class="btn btn-default js-cancel">Cancel</button><button class="btn btn-primary js-primary">Save</button></div></div></div></div>');

/* handle the link button */
$(".js-link").click(function() {
	var url = window.prompt('URL','');

	if (url != null) {
		document.execCommand('createLink', false, url);
	}
});

/* edit source button */
$('.js-wysiwyg-source').click(function() {
	var source_id =  $(this).closest('.wysiwyg-toolbar').data('target');

	/* add the html text area to the model with the source in it */
	$('p#wysiwyg-source-modal-body').html('<textarea id="wysiwyg_source_raw_edit" style="font: 12px/14px Courier, mono; width: 98%; height: 370px">' + $(source_id).cleanHtml() + '</textarea>');

	/* show the dialog */
	$('#wysiwyg-source-modal').modal('show');

	/* handle close */
	$('#wysiwyg-source-modal .js-cancel').on('click',function() {
		$('#wysiwyg-source-modal').modal('hide');
	});

	/* handle ok button */
	$('#wysiwyg-source-modal .js-primary').on('click',function() {
		$(source_id).html($('#wysiwyg_source_raw_edit').val());

		$('#wysiwyg-source-modal').modal('hide');
	});
});

/* add the textarea after each wysiwyg */
$('.bootstrap-wysiwyg').each(function(idx) {
	var name = $(this).data('textarea');
	var that = this;
	var role = '[data-role=editor-'+name+'-toolbar]';

	$(this).wysiwyg({ toolbarSelector: role});
	$(this).after('<textarea style="display:none" name="' + name + '" id="' + name + '">' + $(this).cleanHtml() + '</textarea>');
	$(this).on('change',function() {
		$('#'+name).val($(that).cleanHtml());
	});
});