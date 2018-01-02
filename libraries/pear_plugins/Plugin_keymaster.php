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

class Plugin_keymaster {
	public function __construct() {
		ci('page')->js([
			'//cdnjs.cloudflare.com/ajax/libs/keymaster/1.6.1/keymaster.min.js',
			'/theme/orange/assets/plugins/keymaster/onready_keymaster.min.js',
		]);
	}
}