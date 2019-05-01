<?php
/**
 * Orange
 *
 * An open source extensions for CodeIgniter 3.x
 *
 * This content is released under the MIT License (MIT)
 * Copyright (c) 2014 - 2019, Project Orange Box
 */

/**
 * Admin Middleware
 *
 * Handles permissions checking as well as loading additional classes as needed
 *
 * @package CodeIgniter / Orange
 * @author Don Myers
 * @copyright 2019
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @version v2.0
 *
 * @uses # load - CodeIgniter Loader
 *
 */
class AdminMiddleware extends \Middleware_base
{
	public function request(array $request) : array
	{
		/**
		 * Create the URL key and test if they have permissions
		 */
		ci('load')->library('auth');

		$key = 'url::/'.strtolower(ci('router')->fetch_directory().ci('router')->fetch_class(true).'::'.ci('router')->fetch_method(true).'~'.ci('router')->fetch_request_method());

		log_message('debug', $key);

		if (ci('user')->cannot($key)) {
			ci('errors')->display(403);
		}

		return $request;
	}
}
