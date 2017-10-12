<?php

class Plugin_color_value {

	public function __construct() {
		html::attach('color_value',function($color,$with_hash=true) {
			return(($with_hash) ? '#' : '').trim($color, '#');
		});
	}

} /* end class */
