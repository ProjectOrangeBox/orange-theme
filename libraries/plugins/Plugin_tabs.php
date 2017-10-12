<?php 

class Plugin_tabs {

	public function __construct() {
		html::attach('tabs',function($array) {
			return array_keys($array);
		});
	}

} /* end class */