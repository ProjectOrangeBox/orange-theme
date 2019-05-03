/* Create the object to hold the properties and methods */
var tableSort = {};

/* Default direction */
tableSort.dir = 'desc';
tableSort.index = 0;
tableSort.iconsAdded = false;

/* Do the actual sort */
tableSort.sort = function(index,dir) {
	if (index > 0) {
		console.log('Sorting column:'+index+' direction:'+dir+' sorting:'+$('table.table-sort tbody tr').length);

		tableSort.determineIcons(index,dir);

		tinysort('table.table-sort tbody tr',{selector:'td:nth-child('+index+')',order:dir,data:'value'},{selector:'td:nth-child('+index+')',order:dir});
	}

	tableSort.save(index,dir);
}

tableSort.addSortIcons = function() {
	if (!tableSort.iconsAdded) {
		$('table.table-sort thead tr th:not(.nosort)').prepend('<i class="fa fa-sort"></i> ');
		tableSort.iconsAdded = true;
	}
}

tableSort.determineIcons = function(index,dir) {
	/* remove all previous arrows and such */
	$('table.table-sort thead tr th i').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-sort');

	/* remove previous highlighted column */
	$('table.table-sort thead tr th').removeClass('active');

	/* add the correct classes to the header */
	$('table.table-sort thead tr th:nth-child('+index+') i').addClass('fa-sort-'+dir).removeClass('fa-sort');

	$('table.table-sort thead tr th:nth-child('+index+')').addClass('active');
}

/* Load the last sort if any */
 tableSort.load = function() {
	var saved = $.jStorage.get(controller_path+'saved_sort_column','');

	if (saved != '') {
		parts = saved.split("\t");

		tableSort.index = parts[0];
		tableSort.dir = parts[1];
	}

	tableSort.sort(tableSort.index,tableSort.dir);
}

/* Save the Last Sort */
 tableSort.save = function(index,dir) {
	$.jStorage.set(controller_path+'saved_sort_column',index + "\t" + dir);
}

document.addEventListener("DOMContentLoaded",function(e){
	tableSort.addSortIcons();

	/* or sort if it's dynamically loaded */
	$(document).on('orange_table_updated',{},function(tbody){
		tableSort.load();
	});

	/* handle clicks */
	$('table.table-sort thead tr th:not(.nosort)').on('click',function() {
		/* which direction are we going now? */
		tableSort.dir = (tableSort.dir == 'asc') ? 'desc' : 'asc';
		tableSort.index = $('table.table-sort thead tr th').index(this) + 1;

		/* find out which column we clicked and send in the dir */
		tableSort.sort(tableSort.index,tableSort.dir);
	});

	//tableSort.load();
});
