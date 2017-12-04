<?php
/*
http://eonasdan.github.io/bootstrap-datetimepicker/
*/

class Plugin_date_time_picker {

	public function __construct() {
		plugin::attach('date_time_picker',function($name = '',$value=null,$extra=[]){
			$extra['format'] = ($extra['format']) ? $extra['format'] : 'MM/DD/YYYY h:mm A';
			$extra['icon'] = ($extra['icon']) ? $extra['icon'] : 'calendar';
		
			return plugin::dt_picker($name,$value,$extra);
		});
	}
	
} /* end class */
