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

class Pear_tab_id {
	public function __construct() {
		pear::attach('tab_id',function($value) {
			return md5($value);
		});
	}
}