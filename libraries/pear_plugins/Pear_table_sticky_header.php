<?php

class Pear_table_sticky_header extends \Pear_plugin
{
	public function __construct()
	{
		ci('page')
			->js('/theme/orange/assets/plugins/table_sticky_header/jquery.stickytableheaders.min.js')
			->domready("$('.table-sticky-header').stickyTableHeaders({fixedOffset: $('.page-header.navbar.navbar-fixed-top')});");
	}
}
