(function ($) {

    var $document = $(document),
        signClass,
        sortEngine;

    $.bootstrapSortable = function (applyLast, sign, customSort) {

        // Check if moment.js is available
        var momentJsAvailable = (typeof moment !== 'undefined');

        // Set class based on sign parameter
        signClass = !sign ? "arrow" : sign;

        // Set sorting algorithm
        if (customSort == 'default') {
            customSort = defaultSortEngine;
        }
        
        sortEngine = customSort || sortEngine || defaultSortEngine;

        // Set attributes needed for sorting
        $('table.sortable').each(function () {
            var $this = $(this);
            applyLast = (applyLast === true);
            $this.find('span.sign').remove();

            // Add placeholder cells for colspans
            $this.find('thead [colspan]').each(function () {
                var colspan = parseFloat($(this).attr('colspan'));
                for (var i = 1; i < colspan; i++) {
                    $(this).after('<th class="colspan-compensate">');
                }
            });

            // Add placeholder cells for rowspans
            $this.find('thead [rowspan]').each(function () {
                var $cell = $(this);
                var rowspan = parseFloat($cell.attr('rowspan'));
                for (var i = 1; i < rowspan; i++) {
                    var parentRow = $cell.parent('tr');
                    var nextRow = parentRow.next('tr');
                    var index = parentRow.children().index($cell);
                    nextRow.children().eq(index).before('<th class="rowspan-compensate">');
                }
            });

            // Set indexes to header cells
            $this.find('thead tr').each(function (rowIndex) {
                $(this).find('th').each(function (columnIndex) {
                    var $this = $(this);
                    $this.addClass('nosort').removeClass('up down');
                    $this.attr('data-sortcolumn', columnIndex);
                    $this.attr('data-sortkey', columnIndex + '-' + rowIndex);
                });
            });

            // Cleanup placeholder cells
            $this.find('thead .rowspan-compensate, .colspan-compensate').remove();

            // Initialize sorting values
            $this.find('td').each(function () {
                var $this = $(this);
                if ($this.attr('data-dateformat') !== undefined && momentJsAvailable) {
                    $this.attr('data-value', moment($this.text(), $this.attr('data-dateformat')).format('YYYY/MM/DD/HH/mm/ss'));
                }
                else {
                    $this.attr('data-value') === undefined && $this.attr('data-value', $this.text());
                }
            });

            var context = lookupSortContext($this),
                bsSort = context.bsSort;

            $this.find('thead th[data-defaultsort!="disabled"]').each(function (index) {
                var $this = $(this);
                var $sortTable = $this.closest('table.sortable');
                $this.data('sortTable', $sortTable);
                var sortKey = $this.attr('data-sortkey');
                var thisLastSort = applyLast ? context.lastSort : -1;
                bsSort[sortKey] = applyLast ? bsSort[sortKey] : $this.attr('data-defaultsort');
                if (bsSort[sortKey] !== undefined && (applyLast === (sortKey === thisLastSort))) {
                    bsSort[sortKey] = bsSort[sortKey] === 'asc' ? 'desc' : 'asc';
                    doSort($this, $sortTable);
                }
            });
            $this.trigger('sorted');
        });
    };



    // jQuery 1.9 removed this object
    if (!$.browser) {
        $.browser = { chrome: false, mozilla: false, opera: false, msie: false, safari: false };
        var ua = navigator.userAgent;
        $.each($.browser, function (c) {
            $.browser[c] = ((new RegExp(c, 'i').test(ua))) ? true : false;
            if ($.browser.mozilla && c === 'mozilla') { $.browser.mozilla = ((new RegExp('firefox', 'i').test(ua))) ? true : false; }
            if ($.browser.chrome && c === 'safari') { $.browser.safari = false; }
        });
    }

    // Initialise on DOM ready
    $($.bootstrapSortable);

}(jQuery));

var signClass = "arrow";

// Sorting mechanism separated
function doSort($this, $table) {
    var sortColumn = parseFloat($this.attr('data-sortcolumn')),
        context = lookupSortContext($table),
        bsSort = context.bsSort;

    var colspan = $this.attr('colspan');
    
		if (colspan) {
        var mainSort = parseFloat($this.data('mainsort')) || 0;
        var rowIndex = parseFloat($this.data('sortkey').split('-').pop());

        // If there is one more row in header, delve deeper
        if ($table.find('thead tr').length - 1 > rowIndex) {
            doSort($table.find('[data-sortkey="' + (sortColumn + mainSort) + '-' + (rowIndex + 1) + '"]'), $table);
            return;
        }
        // Otherwise, just adjust the sortColumn
        sortColumn = sortColumn + mainSort;
    }

    var localSignClass = $this.attr('data-defaultsign') || signClass;

    // update arrow icon
    $table.find('th').each(function () {
        $(this).removeClass('up').removeClass('down').addClass('nosort');
    });

    if ($.browser.mozilla) {
        var moz_arrow = $table.find('div.mozilla');
        if (moz_arrow !== undefined) {
            moz_arrow.find('.sign').remove();
            moz_arrow.parent().html(moz_arrow.html());
        }
        $this.wrapInner('<div class="mozilla"></div>');
        $this.children().eq(0).append('<span class="sign ' + localSignClass + '"></span>');
    }
    else {
        $table.find('span.sign').remove();
        $this.append('<span class="sign ' + localSignClass + '"></span>');
    }

    // sort direction
    var sortKey = $this.attr('data-sortkey');
    var initialDirection = $this.attr('data-firstsort') !== 'desc' ? 'desc' : 'asc';

    context.lastSort = sortKey;
    bsSort[sortKey] = (bsSort[sortKey] || initialDirection) === 'asc' ? 'desc' : 'asc';
    if (bsSort[sortKey] === 'desc') {
        $this.find('span.sign').addClass('up');
        $this.addClass('up').removeClass('down nosort');
    } else {
        $this.addClass('down').removeClass('up nosort');
    }

    // sort rows
    var rows = $table.children('tbody').children('tr');

		if (rows.length != 0) {
        defaultSortEngine(rows, { selector: 'td:nth-child(' + (sortColumn + 1) + ')', order: bsSort[sortKey], data: 'value' });
    }

    // add class to sorted column cells
    $table.find('td.sorted, th.sorted').removeClass('sorted');
    rows.find('td:eq(' + sortColumn + ')').addClass('sorted');
    
		$this.addClass('sorted');
}


// Look up sorting data appropriate for the specified table (jQuery element).
// This allows multiple tables on one page without collisions.
function lookupSortContext($table) {
    var context = $table.data("bootstrap-sortable-context");
    if (context === undefined) {
        context = { bsSort: [], lastSort: undefined };
        $table.find('thead th[data-defaultsort!="disabled"]').each(function (index) {
            var $this = $(this);
            var sortKey = $this.attr('data-sortkey');
            context.bsSort[sortKey] = $this.attr('data-defaultsort');
            if (context.bsSort[sortKey] !== undefined) {
                context.lastSort = sortKey;
            }
        });
        $table.data("bootstrap-sortable-context", context);
    }
    return context;
}

function defaultSortEngine(rows,params) {
	tinysort(rows,params);
}
