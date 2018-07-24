/* https://github.com/drvic10k/bootstrap-sortable */

/*
search
Tyson - tyson
Tyson|Dog - tyson or dog
Tyson(.*)Dog - tyson and dog (anything between)

*/

// Add click event to table header
$(document).on('click', 'table.sortable thead th[data-defaultsort!="disabled"]', function (e) {
	document.body.style.cursor = 'wait';

	var $this = $(this);
	var $table = $this.closest('table.sortable');

	doSort($this, $table);

	/* save */
	var column_id = $this.data('sortcolumn');
	var is_up = ($this.hasClass('up')) ? 'up' : 'down';

	/* maybe pass this to php for a sort would be easier? */
	$.jStorage.set(controller_path+'saved_filter_sort',column_id+'@'+is_up);

	document.body.style.cursor = 'default';
});


/* filter with debounce */
$('#search_sort_filter').on('keyup',debounce(function(){search_sort_filter();},500));

function search_sort_filter() {
	$.jStorage.set(controller_path+'saved_filter',$('#search_sort_filter').val());

	var rex = new RegExp($('#search_sort_filter').val(), 'i');

	/* hide the tr's */
	$('.searchable tr').hide();

	/* filter them */
	$('.searchable tr').filter(function () {
		return rex.test($(this).text());
	}).show(); /* show them again */

	search_sort_filter_count();
}

function search_sort_filter_count() {
	var vis = $('table.table.orange tbody tr:visible').length;
	var all = $('table.table.orange tbody tr').length;
	
	var shown = (vis != all) ? vis + ' of ' + all : all;

	$('#search_sort_filter_records_shown').html(shown);
}

document.addEventListener("DOMContentLoaded",function(e){
	/* reload saved filter */
	var saved_filter = $.jStorage.get(controller_path+'saved_filter','');

	if (saved_filter.length > 0) {
		$('#search_sort_filter').val(saved_filter).trigger('keyup');
	} else {
		/* no search */
		$('table tbody.searchable tr').show();

		search_sort_filter_count();
	}
});

function debounce(func, wait, immediate) {
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

/* reload saved filter sort */
/*
var saved_filter_sort = $.jStorage.get(controller_path+'saved_filter_sort','');

if (saved_filter_sort.length > 0) {
	document.body.style.cursor = 'wait';

	var parts = saved_filter_sort.split('@');

	setTimeout(function() {
		var c = $('.tableFloatingHeaderOriginal [data-sortcolumn="' + parts[0] + '"]');

		while (!c.hasClass(parts[1])) {
			c.trigger('click');
		}

		document.body.style.cursor = 'default';
	}, 200);
}
*/
