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

class Pear_fa_enum_icon {
	public function __construct() {
		pear::attach('fa_enum_icon',function($value=-1,$string = 'circle-o|check-circle-o',$extra='fa-lg',$delimiter = '|') {
			$enum = explode($delimiter,$string);
			return '<i class="fa fa-'.$enum[(int)$value].' '.$extra.'"></i>';
		});
	}
}