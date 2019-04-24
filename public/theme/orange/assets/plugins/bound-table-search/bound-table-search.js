/* Create the object to hold the search properties and methods */
var BoundTableSearch = {};

BoundTableSearch.currentSearch = '';

/* Do the actual search */
BoundTableSearch.search = function() {
	BoundTableSearch.currentSearch = BoundTableSearch.getField();
	BoundTableSearch.regular_expression_search(BoundTableSearch.currentSearch);
	BoundTableSearch.save(BoundTableSearch.currentSearch);
}

/* Do a regular expression search on the table */
BoundTableSearch.regular_expression_search = function(searchTerm) {
	BoundTableSearch.determineIcons(searchTerm);

	if (searchTerm) {
		if (searchTerm.length > 0) {
			console.log('filtering: ' + $(BoundTableSearch.table_class).length);
			/* run filter */
			var rex = new RegExp(searchTerm, 'i');

			/* hide the tr's */
			$(BoundTableSearch.table_class).hide();

			/* filter them */
			$(BoundTableSearch.table_class).filter(function () { return rex.test($(this).text()); }).show(); /* show them again */
		} else {
			console.log('filtering: show all');
			/* show all */
			$(BoundTableSearch.table_class).show();
		}
	}

	BoundTableSearch.updateCount();
}

BoundTableSearch.updateCount = function() {
	var vis = $(BoundTableSearch.table_class+':visible').length;
	var all = $(BoundTableSearch.table_class).length;
	var shown = (vis != all) ? vis + ' of ' + all : all;

	BoundTableSearch.count_element.html(shown);
}

/* Load the search term into the input field and do the search */
BoundTableSearch.load = function() {
	BoundTableSearch.currentSearch = $.jStorage.get(controller_path+'saved_filter','');

	if (BoundTableSearch.currentSearch != '') {
		/* put it back in the field */
		BoundTableSearch.setField(BoundTableSearch.currentSearch);

		/* do the search */
		BoundTableSearch.search();
	}
}

/* Place the last search into the search box change the background color as needed */
BoundTableSearch.save = function(searchTerm) { $.jStorage.set(controller_path+'saved_filter',searchTerm); }

/* Set and Get the search from the search field */
BoundTableSearch.setField = function(searchTerm) { BoundTableSearch.currentSearch = searchTerm; BoundTableSearch.field.val(searchTerm); }
BoundTableSearch.getField = function() { return BoundTableSearch.field.val(); }

BoundTableSearch.determineIcons = function(searchTerm) {
	if (searchTerm) {
		if (searchTerm.length > 0) {
			BoundTableSearch.field.css({'background-color':'#F0F2F7'});
			BoundTableSearch.field.next().addClass('text-info');
		} else {
			BoundTableSearch.field.css({'background-color':''});
			BoundTableSearch.field.next().removeClass('text-info');
		}
	}
}

/* Update Trigger Handler */
$(document).on('orange_table_updated',{},function() { BoundTableSearch.search(); });

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
});