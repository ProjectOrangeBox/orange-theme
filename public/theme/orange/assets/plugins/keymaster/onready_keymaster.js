/**
 * 
 * Listen for saves, cancels, and new keyboard events
 *
 */
document.addEventListener("DOMContentLoaded",function(e){

	/* go back button */
	key('esc', function(){
		/* look for a <a href="" class="js-esc"> element and go to the href (url) */
		
		if ($('a.js-esc').attr('href') != undefined) {
			window.location = $('a.js-esc').attr('href');
		}
	});
	
	/* save button */
	key('command+s, ctrl+s', function(event){
		event.preventDefault();
		
		/* look for the class="keymaster-s" and trigger a click on it */
		$('.keymaster-s').trigger('click');
	});
	
	/* new button */
	key('f1', function(event){
		event.preventDefault();
		
		/* look for the <a href="" class="js-new"> element and go to the href (url) */
		if ($('a.js-new').attr('href') != undefined) {
			window.location = $('a.js-new').attr('href');
		}
	});

});
