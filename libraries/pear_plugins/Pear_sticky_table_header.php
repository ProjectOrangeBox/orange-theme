<?php

ci('page')
	->js('/theme/orange/assets/plugins/orange-sticky-table-header/jquery.stickytableheaders.min.js')
	->domready("$('table.orange').stickyTableHeaders({fixedOffset: $('.page-header.navbar.navbar-fixed-top')});");
