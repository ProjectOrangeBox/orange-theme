/*
search / filter
Tyson - tyson
Tyson|Dog - tyson or dog
Tyson(.*)Dog - tyson and dog (anything between)

Note:
table must have table-search classes on it
a element with a id of table-search-field-count will show the x of x text
the search field must have the id of table-search-field

*/

var table_search_field = {};

table_search_field.table_class = 'table.table-search tbody tr';
table_search_field.field = $('#table-search-field');
table_search_field.count_element = $('#table-search-field-count');
table_search_field.tbody = $('table.table-search tbody');


table_search_field.search = function(search_term) {
	var url = table_search_field.field.data('url');
	
	if (url) {
		table_search_field.manual_search(search_term,url);
	} else {
		table_search_field.regular_expression_search(search_term);
	}

	table_search_field.update_count();
	table_search_field.save(search_term);
}

table_search_field.update_count = function() {
	var vis = $(table_search_field.table_class+':visible').length;
	var all = $(table_search_field.table_class).length;
	var shown = (vis != all) ? vis + ' of ' + all : all;

	table_search_field.count_element.html(shown);
}

table_search_field.manual_search = function(search_term,url) {
	orange.post(url,{search:search_term},function(data){
		table_search_field.tbody.html(data.tbody);
		table_search_field.update_count();
	});
}

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
}

table_search_field.load = function() {
	var saved = $.jStorage.get(controller_path+'saved_filter','');
	
	/* put it back in the field */
	table_search_field.set_field(saved);
	
	/* do the search */
	table_search_field.search(saved);
}

table_search_field.save = function(search_term) {
	$.jStorage.set(controller_path+'saved_filter',search_term);

	if (search_term.length > 0) {
		table_search_field.field.css({'background-color':'#F0F2F7'});
		table_search_field.field.next().addClass('text-info');
	} else {
		table_search_field.field.css({'background-color':''});
		table_search_field.field.next().removeClass('text-info');
	}
}

table_search_field.set_field = function(search_term) {
	table_search_field.field.val(search_term);
}

table_search_field.get_field = function() {
	return table_search_field.field.val();
}

/* text field search with debounce */
table_search_field.field.on('keyup',debounce(function(){
	table_search_field.search(table_search_field.get_field());
},500));

/* add listener to handle putting back in the search term on page ready */
document.addEventListener("DOMContentLoaded",function(e){
	table_search_field.load();
});