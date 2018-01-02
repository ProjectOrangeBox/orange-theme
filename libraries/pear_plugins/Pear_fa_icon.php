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

class Pear_fa_icon {
	public function __construct() {
		pear::attach('fa_icon',function($name='') {
			return '<i class="fa fa-'.$name.'"></i>';
		});
	}
}