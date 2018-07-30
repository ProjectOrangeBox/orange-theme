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
		ci('output')->parse_exec_vars = false;

		if ((int) ci()->cache_page_for > 0) {
			ci('output')->cache((int) ci()->cache_page_for);
		}

		ci('page')->body_class(orange_middleware::requests())->data([
			'controller'        => ci()->controller,
			'controller_path'   => ci()->controller_path,
			'controller_title'  => ci()->controller_title,
			'controller_titles' => ci()->controller_titles,
		]);
	}
}
