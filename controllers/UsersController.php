<?php

class UsersController extends MY_Controller {
	use admin_trait;

	public $controller        = 'users';
	public $controller_title  = 'User';
	public $controller_titles = 'Users';
	public $controller_path   = '/users';
	public $controller_model  = 'o_user_model';

	public function edit_profileAction($id) {
		/* let's make sure the $id is in the correct format */
		$this->validate->variable($this->o_user_model->rule($this->o_user_model->get_primary_key(),'rules'),$id)->die_on_fail();

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

			$this->_add_roles();
		}

		$this->_rest_output();
	}

	protected function _add_roles($user_id=null) {
		/* if no errors save the roles */
		if (!errors::has()) {
			$user_id = ($user_id) ? $user_id : (int)$this->input->request('id');

			/* first remove all of the roles */
			$this->o_user_model->remove_role($user_id,null);

			/* add the new ones */
			$this->o_user_model->add_role($user_id,$this->input->request('roles'));
		}
	}

} /* end class */