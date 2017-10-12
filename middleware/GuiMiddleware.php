<?php
/**
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
 * required
 * core:
 * libraries:
 * models:
 * helpers:
 *
 */

class GuiMiddleware extends Middleware_base {

	public function run() {
		/* turn this off for a little speed */
		$this->output->parse_exec_vars = false;

		/* turn on output caching for this page? */
		if ((int) $this->cache_page_for > 0) {
			$this->output->cache((int) $this->cache_page_for);
		}

		/* Doing GUI so, load the Page Library */
		$this->load->library('page');

		$this->page->body_class(implode(' ',$this->controller_middleware_as_body_classes));
	}

} /* end class */