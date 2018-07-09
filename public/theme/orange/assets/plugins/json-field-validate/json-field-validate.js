json_field_validate = {};

document.addEventListener("DOMContentLoaded",function(e){
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
});

function IsJsonString(str) {
	try { JSON.parse(str); } catch (e) { return false; }
	
	return true;
}