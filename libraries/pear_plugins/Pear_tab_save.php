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

class Pear_tab_save {
	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/orange-tab-save/orange-tab-save.min.js');
	}
}
