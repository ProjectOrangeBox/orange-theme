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

class AdminMiddleware extends Middleware_base {

	public function run() {
		$this->load->library(['auth','user']);

		$route = strtolower($this->router->fetch_directory() . $this->router->fetch_class(true) . '/' . $this->router->fetch_request_method() . '~' . $this->router->fetch_method(true));

		$key = 'url::/'.$route;

		if (ENVIRONMENT == 'development') {
			$this->o_permission_model->insert(['description' => '*'.ucwords(str_replace('/',' ',$route)), 'group' => $this->router->fetch_class(true), 'key' => $key]);
		}

		if (user::cannot($key)) {
			errors::display(403);
		}
	}

} /* end class */