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

class Plugin_tab_title {
	public function __construct() {
		pear::attach('tab_title',function($string) {
			return htmlspecialchars(ucwords($string), ENT_QUOTES, 'UTF-8');
		});
	}
}