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

class Pear_date {
	public function __construct() {
		pear::attach('date',function($format,$timestamp) {
			$format = (!empty($format)) ? $format : config('application.human date');
			$timestamp = (is_integer($timestamp)) ? $timestamp : strtotime($timestamp);

			return ($timestamp > 1000) ? date($format,$timestamp) : '';
		});
	}
}
