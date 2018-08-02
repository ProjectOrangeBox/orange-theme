$(document).on('orange_table_updated',{},function(tbody){
	var ypos = $.jStorage.get(controller_path+'scrollTop',null);
	
	if (ypos > 0) {
		$(window).scrollTop(ypos);
	}
});

$(window).scroll(function() {
	$.jStorage.set(controller_path+'scrollTop',$(window).scrollTop());
});