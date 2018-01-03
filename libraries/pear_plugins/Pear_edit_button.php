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

class Pear_edit_button {
	public function __construct() {
		pear::attach('edit_button',function($uri='',$attributes=[]) {
			return anchor($uri,'<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>',$attributes);
		});
	}
}
