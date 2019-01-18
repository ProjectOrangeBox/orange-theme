/**
 * 
 * handle shift when selecting group access
 *
 */
$('input').click(function(event) {
	if (event.shiftKey) {
		/* data-group="group name" */
		$('[data-group="' + $(this).data('group') + '"]').prop('checked',($(this).prop('checked') || false));
	}
});

/**
 * 
 * handle shift in a tab group
 *
 */
$('div.tab-content :checkbox').click(function(event) {
	if (event.shiftKey) {
		$('div.tab-pane.active :checkbox').prop('checked',($(this).prop('checked') || false));
	}
});

/**
 * 
 * attach to a field to link to another field (probably readonly) 
 * to create a computer safe value
 * <input class="js-human-input" data="computer-input"...
 * other options include:
 * data-always="true"
 * 
 * Note: on Post this is always filled in since it is a new record
 *
 */
$('.js-human-input').on('keyup blur',function(e) {
	var always = $(this).data('always');
	
	if ($(this).closest('form').attr('method').toLowerCase() == 'post') {
		always = true;
	}

	if (always) {
		/* uses tool.js url_title function */
		$("input[name='"+$(this).data('computer-input')+"']").val(url_title($(this).val()));
	}
});

/**
 * 
 * add max length to textareas pre-html5
 * <textarea maxlength="255"...
 *
 */
$('textarea[maxlength]').bind('input propertychange', function() {
	var maxLength = $(this).attr('maxlength');

	if ($(this).val().length > maxLength) {
		$(this).val($(this).val().substring(0, maxLength));
	}
});

/**
 * 
 * this adds json syntax checking to textareas
 * <textarea class="js-validate-json"...
 *
 */
$(document).on('keyup focus','.js-validate-json',function(e){
	if (IsJsonString($(this).val())) {
		/* is good */
		$(this).closest('div').removeClass('has-error');
	} else {
		/* fall */
		$(this).closest('div').addClass('has-error');
	}

});

/**
 * 
 * Test if the input is JSON
 *
 */
function IsJsonString(str) {
	try { JSON.parse(str); } catch (e) { return false; }
	
	return true;
}