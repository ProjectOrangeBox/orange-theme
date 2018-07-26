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
	public function __construct() {
		ci('output')->parse_exec_vars = false;
		if ((int) $this->cache_page_for > 0) {
			ci('output')->cache((int) $this->cache_page_for);
		}
		ci('page')->body_class(orange_middleware::get())->data([
			'controller'        => $this->controller,
			'controller_path'   => $this->controller_path,
			'controller_title'  => $this->controller_title,
			'controller_titles' => $this->controller_titles,
		]);
	}
}
