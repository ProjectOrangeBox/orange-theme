/* turn checkbox into text input so we always get something */
$(".js-checker").each(function(index,value) {
	/* clear out the name and add a hidden field right after it */
	$(this).change(function(){
		$("input[name='" + $(this).data('realname') + "']").attr('value',(($(this).is(':checked')) ? ($(this).data('on') || 1) : ($(this).data('off') || 0)));
	}).attr('name','').data('realname',$(this).attr('name')).after('<input type="hidden" name="'+$(this).attr('name')+'" value="' + (($(this).is(':checked')) ? ($(this).data('on') || 1) : ($(this).data('off') || 0)) + '">')
});

/* handle shift when selecting group access */
$('input').click(function(event) {
	if (event.shiftKey) {
		/* data-group="group name" */
		$('[data-group="' + $(this).data('group') + '"]').prop('checked',($(this).prop('checked') || false));
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
$("textarea[maxlength]").bind('input propertychange', function() {
	var maxLength = $(this).attr('maxlength');

	if ($(this).val().length > maxLength) {
		$(this).val($(this).val().substring(0, maxLength));
	}
});