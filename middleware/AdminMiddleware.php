<?php
/**
 * AdminMiddleware
 * Insert description here
 *
 * @package CodeIgniter / Orange
 * @author Don Myers
 * @copyright 2018
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @version 2.0
 *
 * required
 * core:
 * libraries:
 * models:
 * helpers:
 * functions:
 *
 */
class AdminMiddleware extends Middleware_base {
	public function request() {
		$this->load->library('auth');

		$key = 'url::/'.strtolower($this->router->fetch_directory().$this->router->fetch_class(true).'::'.$this->router->fetch_method(true).'~'.$this->router->fetch_request_method());

		log_message('debug',$key);

		if ($this->user->cannot($key)) {
			$this->errors->display(403);
		}
	}
}