<?php
/**
 * $timestamp
 * Insert description here
 *
 * @param $format
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('date',function($timestamp,$format=null) {
	$format = (!empty($format)) ? $format : config('application.human date','F jS, Y, g:i a');
	$timestamp = (is_integer($timestamp)) ? $timestamp : strtotime($timestamp);
	return ($timestamp > 1000) ? date($format,$timestamp) : '';
});
