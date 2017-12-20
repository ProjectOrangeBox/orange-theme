<?php
class LoginController extends MY_Controller {
	public $controller_path   = '/login';
	//public $libraries = ['auth','auto_login'];

	public function indexAction() {
		/* are do they have a remember cookie? */
		if (ci('auto_login')->test()) {
			redirect(site_url('{dashboard}'));
		}
		
		/* anti script kiddie */
		ci('output')->set_cookie('config',md5(ci('input')->server('REMOTE_ADDR')),3600);

		ci('page')->render();
	}

	public function indexPostAction() {
		/* anti script kiddie */
		if (ci('input')->cookie('config') != md5(ci('input')->server('REMOTE_ADDR'))) {
			ci('wallet')->msg(config('auth.general failure error'),'red',$this->controller_path);
		}

		ci('output')->set_cookie('config','');

		if (!ci('auth')->login($this->input->request('email'),ci('input')->request('password'))) {
			ci('wallet')->msg(errors::as_html('','<br>'),'red',$this->controller_path);
		}

		if (ci('input')->request('remember')) {
			ci('auto_login')->create(ci('user')->id);
		}

		redirect(site_url('{dashboard}'));
	}

	public function invertedAction() {
		ci('auth')->logout();

		ci('auto_login')->clear();

		ci('wallet')->msg('Your are now logged out.','blue',$this->controller_path);
	}

} /* end class */