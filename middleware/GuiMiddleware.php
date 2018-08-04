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
class GuiMiddleware extends Middleware_base {
	public function request() {
		$this->load->library('page');

		/* this will speed it up a little bit */
		$this->output->parse_exec_vars = false;

		if ((int)$this->cache_page_for > 0) {
			$this->output->cache((int) $this->cache_page_for);
		}

		$controller_path = '/'.str_replace('/index','',$this->router->fetch_route());
		$base_url = trim(base_url(),'/');		
				
		$uid = 'guest';
		$is = 'not-active';

		/* this is a variable test */
		if (isset($this->user)) {
			$uid = md5($this->user->id.config('config.encryption_key'));
			
			if ($this->user->logged_in()) {
				$is = 'active';
			}
		}

		$body_classes[] = trim(str_replace('/',' uri-',str_replace('_','-',$controller_path))).' uid-'.$uid.' is-'.$is;
		
		$this->page->body_class($body_classes)
			->js_variables([
				'base_url'				=> $base_url,
				'app_id'					=> md5($base_url),
				'controller_path' => $controller_path,
				'user_id'					=> $uid,
			])
			->data([
				'controller'        => $this->controller,
				'controller_path'   => $this->controller_path,
				'controller_title'  => $this->controller_title,
				'controller_titles' => $this->controller_titles,
			]);
	}
}