<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @link http://eonasdan.github.io/bootstrap-datetimepicker/
 *
 */

class Pear_date_picker {
	public function __construct() {
		pear::attach('date_picker',function($name = '',$value=null,$extra=[]) {
			$extra['format'] = ($extra['format']) ? $extra['format'] : 'MM/DD/YYYY';
			$extra['icon'] = ($extra['icon']) ? $extra['icon'] : 'calendar';
			return pear::dt_picker($name,$value,$extra);
		});
	}
}