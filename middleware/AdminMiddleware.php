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

class AdminMiddleware extends Middleware_base {
	public function __construct() {
		$key = 'url::/'.strtolower($this->router->fetch_directory().$this->router->fetch_class(true).'::'.$this->router->fetch_method(true).'~'.$this->router->fetch_request_method());

		if (user::cannot($key)) {
			ci('errors')->display(403);
		}
	}
}
