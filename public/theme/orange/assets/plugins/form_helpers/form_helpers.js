/* handle shift when selecting group access */
$('input').click(function(event) {
	if (event.shiftKey) {
		/* data-group="group name" */
		$('[data-group="' + $(this).data('group') + '"]').prop('checked',($(this).prop('checked') || false));
	}
});

/* handle shift in a tab group */
$('div.tab-content :checkbox').click(function(event) {
	if (event.shiftKey) {
		$('div.tab-pane.active :checkbox').prop('checked',($(this).prop('checked') || false));
	}
});

$('.js-human-input').on('keyup blur',function(index) {
	/* on new always replace or always */
	if ($('#id').val() == '-1' || $('.js-computer-input').data('always') == true) {
		/* uses tool.js url_title function */
		$('.js-computer-input').val(url_title($(this).val()));
	}
});

/* add max length to textareas pre-html5 */
$('textarea[maxlength]').bind('input propertychange', function() {
	var maxLength = $(this).attr('maxlength');

	if ($(this).val().length > maxLength) {
		$(this).val($(this).val().substring(0, maxLength));
	}
});

/* this adds json syntax checking to textareas */
$(document).on('keyup focus','.js-validate-json',function(e){
	if (IsJsonString($(this).val())) {
		/* is good */
		$(this).closest('div').removeClass('has-error');
	} else {
		/* fall */
		$(this).closest('div').addClass('has-error');
	}

});

function IsJsonString(str) {
	try { JSON.parse(str); } catch (e) { return false; }
	
	return true;
}