/**
 * 
 * <input type="text" readonly id="" name="" value="" class="" style="width:100%; display:inline">
 * <a style="margin-left: -24px" class="js-locked-field-lock" href="#" data-lock="true"><i class="fa fa-lock"></i></a>
 *
 * Note: normally this is automatically loaded using the pear::locked_field() plugin
 *
 * pear::locked_field('name','value',['can'=>'unlock field']);
 *
 * also note if the "extra" key "method" equals "post" then the local is disabled
 * this makes it so all "new" record don't need to be locked/unlocked.
 * pear::locked_field('name','value',['can'=>'unlock field','method'=>$form_method]);
 * this is really only useful on updates (PATCH / editing)
 *
 */
document.addEventListener("DOMContentLoaded",function(e){
	/* find all the locked fields */
	$('.js-locked-field-lock').click(function() {

		/* now determine which mode are we in locked or unlocked? */
		if ($(this).data('lock')) {
			/* turn off readonly on the field */
			$(this).data('lock',false).prev().attr('readonly',false);
			/* change the icon */
			$(this).find('i').removeClass('fa-lock').addClass('fa-unlock');
		} else {
			/* turn on readonly on the field */
			$(this).data('lock',true).prev().attr('readonly',true);
			/* change the icon */
			$(this).find('i').removeClass('fa-unlock').addClass('fa-lock');
		}
	});
});