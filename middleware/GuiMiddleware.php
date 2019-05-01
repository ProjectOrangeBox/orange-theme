<?php
/**
 * GuiMiddleware
 * Insert description here
 *
 * @package CodeIgniter / Orange
 * @author Don Myers
 * @copyright 2018
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @version v2.0
 *
 * required
 * core:
 * libraries:
 * models:
 * helpers:
 * functions:
 *
 */
class GuiMiddleware extends \Middleware_base
{
	public function request(array $request) : array
	{
		ci('load')->library('page');

		/* this will speed it up a little bit */
		ci('output')->parse_exec_vars = false;

		$route = ci('router')->fetch_route();

		$controller_path = '/'.str_replace('/index', '', $route);

		/* is the user object setup? */
		if (is_object(ci('user'))) {
			$uid = 'uid-'.md5(ci('user')->id.config('config.encryption_key'));
			$is = (ci('user')->logged_in()) ? 'is-logged-in' : 'is-not-logged-in';
		} else {
			$uid = 'uid-guest';
			$is = 'is-not-logged-in';
		}

		$base_url = trim(base_url(), '/');

		ci('page')
			->set_default_view(str_replace('-', '_', $route))
			->body_class([str_replace('/', ' uri-', str_replace('_', '-', $controller_path)).' '.$uid.' '.$is])
			->js_variables([
				'base_url'				=> $base_url,
				'app_id'					=> md5($base_url),
				'controller_path' => $controller_path,
				'user_id'					=> $uid,
			])
			->data([
				'controller'        => ci()->controller,
				'controller_path'   => ci()->controller_path,
				'controller_title'  => ci()->controller_title,
				'controller_titles' => ci()->controller_titles,
			]);

		return $request;
	}
}
