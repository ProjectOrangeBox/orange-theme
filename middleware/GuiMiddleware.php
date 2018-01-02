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

class GuiMiddleware extends Middleware_base {
	public function run() {
		ci('output')->parse_exec_vars = false;

		if ((int) $this->cache_page_for > 0) {
			ci('output')->cache((int) $this->cache_page_for);
		}

		ci('page')->body_class(implode(' ',$this->controller_middleware_as_body_classes));
	}
}