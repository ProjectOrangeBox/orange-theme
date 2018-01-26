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

class LoginController extends MY_Controller {
	public $controller_path   = '/login';

	public function indexAction() {
		ci('page')->render();
	}

	public function indexPostAction() {
		if (ci('auth')->login(ci('input')->request('email'),ci('input')->request('password'))) {
			redirect(site_url('{dashboard}'));
		}

		ci('wallet')->msg(ci('errors')->as_html('','<br>'),'red',$this->controller_path);
	}

	public function invertedAction() {
		ci('auth')->logout();

		ci('wallet')->msg('Your are now logged out.','blue',site_url('{homepage}'));
	}

} /* end LoginController */
