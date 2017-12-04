<?php 

class Plugin_tab_title {

	public function __construct() {
		plugin::attach('tab_title',function($string) {
			return htmlspecialchars(ucwords($string), ENT_QUOTES, 'UTF-8');
		});
	}

} /* end class */