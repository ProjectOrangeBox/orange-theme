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

class UsersController extends MY_Controller {
	use admin_controller_trait;

	public $controller        = 'users';
	public $controller_title  = 'User';
	public $controller_titles = 'Users';
	public $controller_path   = '/admin/users';
	public $controller_model  = 'o_user_model';
	public $controller_order_by = 'username';
	public $catalogs = [
		'roles_catalog'=>['model'=>'o_role_model','array_key'=>'id','select'=>'name'],
	];

	public function indexPostAction() {
		if (ci('input')->request('confirm_password') != ci('input')->request('password')) {
			errors::add('Your Passwords do not match.');
		} else {
			$this->data['primary_key'] = ci('o_user_model')->insert(ci('input')->request());

			$this->_add_roles($this->data['primary_key']);
		}

		$this->_rest_output();
	}

	public function indexPatchAction() {
		$data = ci('input')->request();

		if (ci('input')->request('confirm_password') != ci('input')->request('password')) {
			errors::add('Your Passwords do not match.');
		} else {
			if (empty($data['password'])) {
				unset($data['password']);
			}

			ci('o_user_model')->update($data);

			$this->_add_roles();
		}

		$this->_rest_output();
	}

	public function indexDeleteAction() {
		ci('o_user_model')->delete(hex2bin(ci('input')->request('id')));

		if (!errors::has()) {
			ci('o_user_model')->remove_role(ci('input')->request('id'),array_keys(ci('o_user_model')->roles(ci('input')->request('id'))));
		}

		$this->_rest_output();
	}

	protected function _add_roles($user_id=null) {
		if (!errors::has()) {
			$user_id = ($user_id) ? $user_id : (int)ci('input')->request('id');

			ci('o_user_model')->remove_role($user_id,null);

			ci('o_user_model')->add_role($user_id,ci('input')->request('roles'));
		}
	}

}
