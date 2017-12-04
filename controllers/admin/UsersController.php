<?php

class UsersController extends MY_Controller {
	use admin_trait;

	public $controller        = 'users';
	public $controller_title  = 'User';
	public $controller_titles = 'Users';
	public $controller_path   = '/admin/users';
	public $controller_model  = 'o_user_model';
	public $controller_order_by = 'username';

	/* create a new record - REST post */
	public function indexPostAction() {
		if ($this->input->request('confirm_password') != $this->input->request('password')) {
			errors::add('Your Passwords do not match.');
		} else {
			$this->data['primary_key'] = $this->o_user_model->insert($this->input->request());

			$this->_add_roles($this->data['primary_key']);
		}

		$this->_rest_output();
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

	/* delete a record - REST delete */
	public function indexDeleteAction() {
		$this->o_user_model->delete($this->input->request());

		if (!errors::has()) {
			/* first remove all of the roles */
			$this->o_user_model->remove_role($this->input->request('id'),array_keys($this->o_user_model->roles($this->input->request('id'))));
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