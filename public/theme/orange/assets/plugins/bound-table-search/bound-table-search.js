/* Create the object to hold the search properties and methods */
var BoundTableSearch = {};

/* Do the actual search */
BoundTableSearch.search = function() {
	var searchTerm = BoundTableSearch.getField();

	if (searchTerm != undefined && searchTerm.length > 0) {
		/* run regular expression search on table text */

		/* hide the tr's */
		$(BoundTableSearch.table_class).hide();

		/* wildcard - still needs to be in order of the columns */
		/* build javascript regular expression object */

		var searchReg = searchTerm.replace(/[-[\]{}()+?.,\\^$|#\s]/g, '\\$&');
		searchReg = searchReg.replace(/\*/gi,'(.*)');

		console.log('filter regular expression '+searchReg);

		var rex = new RegExp(searchReg,'img');

		/* filter them */
		$(BoundTableSearch.table_class).filter(function () {
			return rex.test($(this).text().replace(/(\r\n|\n|\r)/gm," "));
		}).show(); /* show this row again */
	} else {
		/* show all */
		$(BoundTableSearch.table_class).show();
	}

	BoundTableSearch.save(searchTerm);
	BoundTableSearch.determineIcons(searchTerm);
	BoundTableSearch.updateCount(searchTerm);
}

BoundTableSearch.updateCount = function(searchTerm) {
	var vis = $(BoundTableSearch.table_class+':visible').length;
	var all = $(BoundTableSearch.table_class).length;
	var shown = (vis != all) ? vis + ' of ' + all : all;

	BoundTableSearch.count_element.html(shown);

	console.log('bound table search filtering on "'+searchTerm+'" showing ' + shown);
}

/* Load the search term into the input field and do the search */
BoundTableSearch.load = function() { BoundTableSearch.setField($.jStorage.get(controller_path+'bts','')); }

/* Place the last search into the search box change the background color as needed */
BoundTableSearch.save = function(searchTerm) { $.jStorage.set(controller_path+'bts',searchTerm); }

/* Set and Get the search from the search field */
BoundTableSearch.setField = function(searchTerm) { BoundTableSearch.field.val(searchTerm); }
BoundTableSearch.getField = function() { return BoundTableSearch.field.val(); }

BoundTableSearch.determineIcons = function(searchTerm) {
	if (searchTerm != undefined && searchTerm.length > 0) {
		BoundTableSearch.field.css({'background-color':'#F0F2F7'});
		BoundTableSearch.field.next().addClass('text-info');
	} else {
		BoundTableSearch.field.css({'background-color':''});
		BoundTableSearch.field.next().removeClass('text-info');
	}
}

/* Update Trigger Handler */
$(document).on('orange_table_updated',{},function() {
	BoundTableSearch.search();
});

/* After the page is loaded load a search */
document.addEventListener("DOMContentLoaded",function(e){
	/* Save a few things for "quick" access */
	BoundTableSearch.table_class = 'table.bound-table-search tbody tr';
	BoundTableSearch.field = $('#bound-table-search-field');
	BoundTableSearch.count_element = $('#table-search-field-count');
	BoundTableSearch.tbody = $('table.bound-table-search tbody');

	/* text field search with debounce */
	BoundTableSearch.field.on('keyup',debounce(function(){ BoundTableSearch.search(); },500));

	BoundTableSearch.load();
	//BoundTableSearch.search();
	$(document).trigger('orange_table_updated');
});