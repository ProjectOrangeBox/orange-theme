<?php 

class Plugin_date {

	public function __construct() {
		plugin::attach('date',function($format,$timestamp) {
			$format = (!empty($format)) ? $format : config('application.human date');
		
			$timestamp = (is_integer($timestamp)) ? $timestamp : strtotime($timestamp);
	
			/* greater than Wednesday, December 31, 1969 7:16:40 PM */
			return ($timestamp > 1000) ? date($format,$timestamp) : '';
		});
	}

} /* end class */