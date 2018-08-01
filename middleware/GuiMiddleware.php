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
class GuiMiddleware {
	public static function request() {
		/* this will speed it up a little bit */
		ci('output')->parse_exec_vars = false;

		if ((int) ci()->cache_page_for > 0) {
			ci('output')->cache((int) ci()->cache_page_for);
		}

		$controller_path = '/'.str_replace('/index','',ci('router')->fetch_route());
		$base_url = trim(base_url(),'/');		
				
		$uid = 'guest';
		$is = 'not-active';

		/* this is a variable test */
		if (isset(ci()->user)) {
			$uid = md5(ci('user')->id.config('config.encryption_key'));
			
			if (ci('user')->logged_in()) {
				$is = 'active';
			}
		}

		$body_classes[] = trim(str_replace('/',' uri-',str_replace('_','-',$controller_path))).' uid-'.$uid.' is-'.$is;
		$body_classes[] = orange_middleware::requests();

		ci('page')
			->body_class($body_classes)
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
	}
}