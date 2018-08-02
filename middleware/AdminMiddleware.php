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
class AdminMiddleware {
	public static function request() {
		$key = 'url::/'.strtolower(ci()->router->fetch_directory().ci()->router->fetch_class(true).'::'.ci()->router->fetch_method(true).'~'.ci()->router->fetch_request_method());

		if (user::cannot($key)) {
			ci('errors')->display(403);
		}
	}

	public static function responds($output) {
		return $output;
	}
}