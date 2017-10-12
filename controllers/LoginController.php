<?php
class LoginController extends MY_Controller {
	public $controller_path   = '/login';
	public $libraries = ['auth','auto_login'];

	public function indexAction() {
		/* are do they have a remember cookie? */
		if ($this->auto_login->test()) {
			redirect(site_url('{dashboard}'));
		}

		$this->page->render();
	}

	public function indexPostAction() {
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