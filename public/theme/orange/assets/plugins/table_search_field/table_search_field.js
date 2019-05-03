/**
 *
 * search / filter
 * Tyson - tyson
 * Tyson|Dog - tyson or dog
 * Tyson(.*)Dog - tyson and dog (anything between)
 *
 * Note:
 * table must have table-search classes on it
 * 		<table class="table-search">
 *
 * a element with a id of table-search-field-count will show the x of x text
 * 		<span id="table-search-field-count"></span>
 *
 * the search field must have the id of table-search-field
 * 		<input type="text" id="table-search-field" class="form-control input-sm" data-url="/backorder_call_center/search" style="width: 222px; background-color: rgb(240, 242, 247);" placeholder="search">
 * 		<input type="text" id="table-search-field" data-url="/admin/backorder/search">
 * 		<input type="text" id="table-search-field">
 *
 * if the search field has the data-url="..." attribute then it will instead call that url as a POST with the search term
 * id the search field DOES NOT has the data-url attribute then it will instead use the javascript search on the current table with the table-search class <table class="table-search">
 *
 */

/**
 *
 * Create the object to hold the search properties and methods
 *
 */
 var table_search_field = {};

/**
 *
 * Save a few things for "quick" access
 *
 */
table_search_field.table_class = 'table.table-search tbody tr';
table_search_field.field = $('#table-search-field');
table_search_field.count_element = $('#table-search-field-count');
table_search_field.tbody = $('table.table-search tbody');

/**
 *
 * Do the actual search
 *
 */
table_search_field.search = function(search_term) {
	console.log('Filtering by "'+search_term+'"');

	var url = table_search_field.field.data('url');

	if (url) {
		table_search_field.manual_search(search_term,url);
	} else {
		table_search_field.regular_expression_search(search_term);
	}

	table_search_field.update_count();
	table_search_field.save(search_term);
}

/**
 *
 * Update the search count
 *
 */
table_search_field.update_count = function() {
	var vis = $(table_search_field.table_class+':visible').length;
	var all = $(table_search_field.table_class).length;
	var shown = (vis != all) ? vis + ' of ' + all : all;

	table_search_field.count_element.html(shown);
}

/**
 *
 * Do a Manual search (ie. send the search term to the server for results
 *
 */
table_search_field.manual_search = function(search_term,url) {
	orange.post(url,{search:search_term},function(data){
		table_search_field.tbody.html(data.tbody);
		table_search_field.update_count();

		/* trigger my own event */
		$(document).trigger('orange_table_updated',table_search_field.tbody);
	});
}

/**
 *
 * Do a regular expression search on the table
 *
 */
 table_search_field.regular_expression_search = function(search_term) {
	if (search_term.length > 0) {
		/* run filter */
		var rex = new RegExp(search_term, 'i');

		/* hide the tr's */
		$(table_search_field.table_class).hide();

		/* filter them */
		$(table_search_field.table_class).filter(function () {
			return rex.test($(this).text());
		}).show(); /* show them again */
	} else {
		/* show all */
		$(table_search_field.table_class).show();
	}

	/**
	 *
	 * register a listener with:
	 *
	 * $(document).on('orange_table_updated',{},function(tbody){
	 * 	add_pass_notice();
	 * 	add_more_than_notice();
	 * });
	 *
	 */
	$(document).trigger('orange_table_updated',table_search_field.tbody);
}

/**
 *
 * Load the search term into the input field and do the search
 *
 */
table_search_field.load = function() {
	var search_term = $.jStorage.get(controller_path+'saved_filter','');

	console.log('Loaded Filter '+controller_path+'saved_filter "'+search_term+'"');

	/* put it back in the field */
	table_search_field.set_field(search_term);

	/* do the search */
	table_search_field.search(search_term);
}

/**
 *
 * Place the last search into the search box
 * change the background color as needed
 *
 */
 table_search_field.save = function(search_term) {
	$.jStorage.set(controller_path+'saved_filter',search_term);

	console.log('Saving Filter '+controller_path+'saved_filter "'+search_term+'"');

	if (search_term.length > 0) {
		table_search_field.field.css({'background-color':'#F0F2F7'});
		table_search_field.field.next().addClass('text-info');
	} else {
		table_search_field.field.css({'background-color':''});
		table_search_field.field.next().removeClass('text-info');
	}
}

/**
 *
 * Change the search term
 *
 */
table_search_field.set_field = function(search_term) {
	table_search_field.field.val(search_term);
}

/**
 *
 * Get the current search term
 *
 */
table_search_field.get_field = function() {
	return table_search_field.field.val();
}

/**
 *
 * text field search with debounce
 *
 */
table_search_field.field.on('keyup',debounce(function(){
	table_search_field.search(table_search_field.get_field());
},500));

/**
 *
 * add listener to handle putting back in the search term on page ready
 *
 */
 document.addEventListener("DOMContentLoaded",function(e){
	table_search_field.load();
});