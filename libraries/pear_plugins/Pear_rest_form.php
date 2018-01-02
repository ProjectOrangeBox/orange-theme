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

class Pear_rest_form {
	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/rest-form/rest-form.min.js');
	}
}