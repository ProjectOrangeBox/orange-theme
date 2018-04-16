<?php

class Pear_sticky_table_header extends Pear_plugin {

	public function __construct() {
		ci('page')
			->js('/theme/orange/assets/plugins/orange-sticky-table-header/jquery.stickytableheaders.min.js')
			->domready("$('table.orange').stickyTableHeaders({fixedOffset: $('.page-header.navbar.navbar-fixed-top')});");
	}

}
