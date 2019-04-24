<?php

class Pear_bound_search extends \Pear_plugin
{
	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/bound-table-search/bound-table-search.min.js');
	}
}
