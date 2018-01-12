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
		$posted = ci('input')->request();

		$this->data['primary_key'] = ci('o_user_model')->insert($posted);

		$this->_add_roles($this->data['primary_key']);

		$this->_rest_output();
	}

	public function indexPatchAction() {
		$posted = ci('input')->request();

		ci('o_user_model')->update($posted);

		$this->_add_roles($posted['id']);

		$this->_rest_output();
	}

	public function indexDeleteAction() {
		ci('o_user_model')->delete(hex2bin(ci('input')->request('id')));

		$this->_rest_output();
	}


	public function send_forgotAction($id=null) {
		ci('forgot_tools_lib')->generate(ci('o_user_model')->get(hex2bin($id)));

		redirect($this->controller_path);
	}

	protected function _add_roles($user_id) {
		if (!errors::has()) {
			ci('o_user_model')->remove_role($user_id,null);

			ci('o_user_model')->add_role($user_id,ci('input')->request('roles'));
		}
	}

}
