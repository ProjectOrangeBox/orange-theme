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

class PublicMiddleware extends Middleware_base {
	public function run() {
		$this->load->library(['auth','user']);
	}
}