document.addEventListener("DOMContentLoaded",function(e){

	/* go back button */
	key('esc', function(){
		if ($('a.js-esc').attr('href') != undefined) {
			window.location = $('a.js-esc').attr('href');
		}
	});
	
	/* save button */
	key('command+s, ctrl+s', function(event){
		event.preventDefault();
	
		$('.keymaster-s').trigger('click');
	});
	
	/* new button */
	key('f1', function(event){
		event.preventDefault();
	
		window.location = $('a.js-new').attr('href');
	});

});
