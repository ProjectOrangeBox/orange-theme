/*
search / filter
Tyson - tyson
Tyson|Dog - tyson or dog
Tyson(.*)Dog - tyson and dog (anything between)

Note:
table must have searchable classes on it
a element with a id of search_sort_filter_records_shown will show the x of x text
the search field must have the id of search_sort_filter

*/

var table_search_field = {};

table_search_field.table_class = 'table.table-search tbody tr';
table_search_field.field = $('#table-search-field');
table_search_field.count_element = $('#table-search-field-count');

table_search_field.search_sort_filter = function(search_term) {
	$.jStorage.set(controller_path+'saved_filter',search_term);

	if (search_term.length > 0) {
		var rex = new RegExp(search_term, 'i');
	
		/* hide the tr's */
		$(table_search_field.table_class).hide();
	
		/* filter them */
		$(table_search_field.table_class).filter(function () {
			return rex.test($(this).text());
		}).show(); /* show them again */
	} else {
		$(table_search_field.table_class).show();
	}

	var vis = $(table_search_field.table_class+':visible').length;
	var all = $(table_search_field.table_class).length;
	
	var shown = (vis != all) ? vis + ' of ' + all : all;

	table_search_field.count_element.html(shown);
}

table_search_field.debounce = function(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};


/* text field search with debounce */
table_search_field.field.on('keyup',table_search_field.debounce(function(){
	table_search_field.search_sort_filter(table_search_field.field.val());
},500));

/* add listener to handle putting back in the search term on page ready */
document.addEventListener("DOMContentLoaded",function(e){
	var saved_filter = $.jStorage.get(controller_path+'saved_filter','');
	
	/* put it back in the field */
	table_search_field.field.val(saved_filter);
	
	/* do the search */
	table_search_field.search_sort_filter(saved_filter);
});