/**
 * 
 * Create the object to hold the properties and methods
 *
 */
var table_sort = {};

/**
 * 
 * Default direction
 *
 */
table_sort.dir = 'desc';

/**
 * 
 * Do the actual sort
 *
 */
table_sort.sort = function(index,dir) {
	/* remove all previous arrows and such */
	$('table.table-sort thead tr th i').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-sort');

	/* remove previous highlighted column */
	$('table.table-sort thead tr th').removeClass('active');

	/* add the correct classes to the header */
	$('table.table-sort thead tr th:nth-child('+index+') i').addClass('fa-sort-'+dir).removeClass('fa-sort');

	$('table.table-sort thead tr th:nth-child('+index+')').addClass('active');

	/* do sort */
	tinysort('table.table-sort tbody tr',{selector:'td:nth-child('+index+')',order:dir,data:'value'},{selector:'td:nth-child('+index+')',order:dir});

	table_sort.save(index,dir);
}

/**
 * 
 * Load the last sort if any
 * 
 *
 */
 table_sort.load = function() {
	var saved = $.jStorage.get(controller_path+'saved_sort_column','');

	if (saved != '') {
		parts = saved.split("\t");

		table_sort.sort(parts[0],parts[1]);
	}
}

/**
 * 
 * Save the Last Sort
 * 
 *
 */
 table_sort.save = function(index,dir) {
	$.jStorage.set(controller_path+'saved_sort_column',index + "\t" + dir);
}

/**
 * 
 * handle clicks
 *
 */
 $('table.table-sort thead tr th:not(.nosort)').prepend('<i class="fa fa-sort"></i> ').on('click',function() {
	/* which direction are we going now? */
	table_sort.dir = (table_sort.dir == 'asc') ? 'desc' : 'asc';

	/* find out which column we clicked and send in the dir */
	table_sort.sort($('table.table-sort thead tr th').index(this) + 1,table_sort.dir);
});

/**
 * 
 * or sort if it's dynamically loaded
 *
 */
 $(document).on('orange_table_updated',{},function(tbody){
	table_sort.load();
});