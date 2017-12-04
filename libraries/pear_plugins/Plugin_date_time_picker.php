<?php
/*
http://eonasdan.github.io/bootstrap-datetimepicker/
*/

class Plugin_date_time_picker {

	public function __construct() {
		pear::attach('date_time_picker',function($name = '',$value=null,$extra=[]){
			$extra['format'] = ($extra['format']) ? $extra['format'] : 'MM/DD/YYYY h:mm A';
			$extra['icon'] = ($extra['icon']) ? $extra['icon'] : 'calendar';
		
			return pear::dt_picker($name,$value,$extra);
		});
	}
	
} /* end class */
