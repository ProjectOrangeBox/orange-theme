$(function(){

	$('.js-locked-field-lock').click(function() {
		/* which mode are we in? */

		if ($(this).data('lock')) {
			$(this).data('lock',false).prev().attr('readonly',false);
			$(this).find('i').removeClass('fa-lock').addClass('fa-unlock');
		} else {
			$(this).data('lock',true).prev().attr('readonly',true);
			$(this).find('i').removeClass('fa-unlock').addClass('fa-lock');
		}

	});

});