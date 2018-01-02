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

class Plugin_tabs {
	public function __construct() {
		pear::attach('tabs',function($array) {
			return array_keys($array);
		});
	}
}