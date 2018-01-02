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

class Plugin_input_mask {
	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/input_mask/input-mask.min.js');
	}
}