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

class Plugin_e {
	public function __construct() {
		pear::attach('e',function($string) {
			return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		});
	}
}