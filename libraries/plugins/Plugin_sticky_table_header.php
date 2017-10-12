<?php

class Plugin_sticky_table_header {

	public function __construct() {
		ci()->page
			->js('/theme/orange/assets/plugins/orange-sticky-table-header/jquery.stickytableheaders.min.js')
			->domready("$('table.orange').stickyTableHeaders({fixedOffset: $('.page-header.navbar.navbar-fixed-top')});");
	}

} /* end class */