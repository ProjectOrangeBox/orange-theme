<?php 

class Plugin_tabs {

	public function __construct() {
		plugin::attach('tabs',function($array) {
			return array_keys($array);
		});
	}

} /* end class */