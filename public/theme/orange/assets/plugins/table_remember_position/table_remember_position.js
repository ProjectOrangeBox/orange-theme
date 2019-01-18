/**
 * 
 * Once the table is loaded (updated) then move to the last saved window position
 *
 */
$(document).on('orange_table_updated',{},function(tbody){
	var ypos = $.jStorage.get(controller_path+'scrollTop',null);
	
	if (ypos > 0) {
		$(window).scrollTop(ypos);
	}
});

/**
 * 
 * Save the Windows Scroll Location
 *
 */
 $(window).scroll(function() {
	$.jStorage.set(controller_path+'scrollTop',$(window).scrollTop());
});