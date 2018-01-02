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

class Pear_form_tools {
	public function __construct() {
		ci('page')
			->js('/theme/orange/assets/plugins/form-tools/onready_form_tools.min.js')
			->js('//gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js')
			->css('//gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css');
	}
}