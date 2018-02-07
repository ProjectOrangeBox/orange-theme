<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
 */

pear::attach('date',function($timestamp,$format=null) {
	$format = (!empty($format)) ? $format : config('application.human date');
	$timestamp = (is_integer($timestamp)) ? $timestamp : strtotime($timestamp);

	return ($timestamp > 1000) ? date($format,$timestamp) : '';
});
