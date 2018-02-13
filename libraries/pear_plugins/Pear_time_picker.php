<?php
/**
 * $name
 * Insert description here
 *
 * @param
 * @param $value
 * @param
 * @param $extra
 * @param
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('time_picker',function($name = '',$value=null,$extra=[]){
	$extra['format'] = ($extra['format']) ? $extra['format'] : 'MM/DD/YYYY h:mm A';
	$extra['icon'] = ($extra['icon']) ? $extra['icon'] : 'calendar';
	return pear::dt_picker($name,$value,$extra);
});
