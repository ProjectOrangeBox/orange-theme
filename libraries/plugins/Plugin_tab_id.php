<?php 

class Plugin_tab_id {

	public function __construct() {
		plugin::attach('tab_id',function($value) {
			return md5($value);
		});
	}

} /* end class */