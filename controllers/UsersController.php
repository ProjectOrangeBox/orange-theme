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
		ci('validate')->variable(ci('o_user_model')->rule(ci('o_user_model')->get_primary_key(),'rules'),$id)->die_on_fail();

		/* is this not you? */
		if (ci('user')->id !== $id) {
			errors::display('general',['heading'=>'Error','message'=>'The User ID is unknown.']);
		}
		
		ci('page')->data(['record'=>ci('o_user_model')->get($id),'form_method'=>'patch'])->render();
	}

	/* update a record - REST patch */
	public function indexPatchAction() {
		$data = ci('input')->request();

		if (ci('input')->request('confirm_password') != ci('input')->request('password')) {
			errors::add('Your Passwords do not match.');
		} else {
			if (empty($data['password'])) {
				unset($data['password']);
			}

			ci('o_user_model')->update($data);
		}

		$this->_rest_output();
	}

} /* end class */