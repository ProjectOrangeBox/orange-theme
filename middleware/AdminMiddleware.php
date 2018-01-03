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

class AdminMiddleware extends Middleware_base {
	public function run() {
		$this->load->library(['auth','user']);

		$key = 'url::/'.strtolower($this->router->fetch_directory().$this->router->fetch_class(true).'::'.$this->router->fetch_method(true).'~'.$this->router->fetch_request_method());

		if (user::has_role(ADMIN_ROLE_ID)) {
			$group = filter_human($this->router->fetch_class(true));
			$description = filter_human($this->router->fetch_directory().$this->router->fetch_request_method().' '.$this->router->fetch_class(true).' '.$this->router->fetch_method(true));

			ci('o_permission_model')->add($key,$group,$description);
		}

		if (user::cannot($key)) {
			errors::display(403);
		}
	}
}
