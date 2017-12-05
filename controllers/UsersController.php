<?php

class UsersController extends MY_Controller {
	use admin_controller_trait;

	public $controller        = 'users';
	public $controller_title  = 'User';
	public $controller_titles = 'Users';
	public $controller_path   = '/users';
	public $controller_model  = 'o_user_model';

	public function edit_profileAction($id) {
		/* let's make sure the $id is in the correct format */
		$this->validate->variable($this->o_user_model->rule($this->o_user_model->get_primary_key(),'rules'),$id)->die_on_fail();

		/* is this not you? */
		if ($this->user->id !== $id) {
			errors::display('general',['heading'=>'Error','message'=>'The User ID is unknown.']);
		}
		
		$this->page->data(['record' => $this->o_user_model->get($id),'form_method' => 'patch'])->render();
	}

	/* update a record - REST patch */
	public function indexPatchAction() {
		$data = $this->input->request();

		if ($this->input->request('confirm_password') != $this->input->request('password')) {
			errors::add('Your Passwords do not match.');
		} else {
			if (empty($data['password'])) {
				unset($data['password']);
			}

			$this->o_user_model->update($data);
		}

		$this->_rest_output();
	}

} /* end class */