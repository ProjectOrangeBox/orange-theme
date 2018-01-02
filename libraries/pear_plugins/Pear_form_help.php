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

class Pear_form_help {
	public function __construct() {
		pear::attach('form_help',function($string) {
			return '<p class="help-block">'.htmlspecialchars($string, ENT_QUOTES, 'UTF-8').'</p>';
		});
	}
}