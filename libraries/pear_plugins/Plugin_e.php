<?php 

class Plugin_e {

	public function __construct() {
		pear::attach('e',function($string) {
			return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		});
	}
	
} /* end class */