/**
 * 
 * This sets up normal bootstrap Tab handling as well as remembering which tab they where on last time there where here.
 *
 */

/**
 * 
 * setup normal tab actions
 *
 */
 $('.js-tabs a').click(function(e) {
	e.preventDefault();
	$(this).tab('show');
});

/**
 * 
 * save tab
 *
 */
 $('.js-tabs li').on('click', function(e) {
	$.jStorage.set(location.pathname, $(e.target).attr('href'), 2592000);
});

var tab = ($.jStorage !== undefined) ? $.jStorage.get(location.pathname,'') : '';

/**
 * 
 * bunch of error handling incase it's not there
 *
 */
if (tab === '') {
	tab = '.js-tabs a:first';
} else {
	tab = '.js-tabs a[href="' + tab + '"]';
}

if ($(tab).length > 0) {
	$(tab).tab('show');
} else {
	if ($('.js-tabs a:first').tab !== undefined) {
		$('.js-tabs a:first').tab('show');
	}
}
