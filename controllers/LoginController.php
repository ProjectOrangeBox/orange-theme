<?php
class LoginController extends MY_Controller {
	public $controller_path   = '/login';
	public $libraries = ['auth','auto_login'];

	public function indexAction() {
		/* are do they have a remember cookie? */
		if ($this->auto_login->test()) {
			redirect(site_url('{dashboard}'));
		}
		
		/* anti script kiddie */
		$this->output->set_cookie('config',md5($this->input->server('REMOTE_ADDR')),3600);

		$this->page->render();
	}

	public function indexPostAction() {
		/* anti script kiddie */
		if ($this->input->cookie('config') != md5($this->input->server('REMOTE_ADDR'))) {
			$this->wallet->msg(config('auth.general failure error'),'red',$this->controller_path);
		}

		$this->output->set_cookie('config','');

		if (!$this->auth->login($this->input->request('email'),$this->input->request('password'))) {
			$this->wallet->msg(errors::as_html('','<br>'),'red',$this->controller_path);
		}

		if ($this->input->request('remember')) {
			$this->auto_login->create(ci()->user->id);
		}

		redirect(site_url('{dashboard}'));
	}

	public function invertedAction() {
		$this->auth->logout();

		$this->auto_login->clear();

		$this->wallet->msg('Your are now logged out.','blue',$this->controller_path);
	}

} /* end class */