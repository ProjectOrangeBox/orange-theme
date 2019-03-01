<?php
/**
 * UsersController
 * Insert description here
 *
 * @package CodeIgniter / Orange
 * @author Don Myers
 * @copyright 2018
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @version v2.0
 *
 * required
 * core:
 * libraries:
 * models:
 * helpers:
 * functions:
 *
 */
class UsersController extends \MY_Controller
{
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

	/**
	 * indexPostAction
	 * Insert description here
	 *
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
	public function indexPostAction() : void
	{
		$posted = ci('input')->request();
		$this->data['primary_key'] = ci('o_user_model')->insert($posted);
		$this->_add_roles($this->data['primary_key']);
		$this->_rest_output();
	}

	/**
	 * indexPatchAction
	 * Insert description here
	 *
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
	public function indexPatchAction() : void
	{
		$posted = ci('input')->request();
		ci('o_user_model')->update($posted);
		$this->_add_roles($posted['id']);
		$this->_rest_output();
	}

	/**
	 * indexDeleteAction
	 * Insert description here
	 *
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
	public function indexDeleteAction() : void
	{
		ci('o_user_model')->delete(hex2bin(ci('input')->request('id')));
		$this->_rest_output();
	}

	/**
	 * _add_roles
	 * Insert description here
	 *
	 * @param $user_id
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
	protected function _add_roles($user_id) : void
	{
		if (!ci('errors')->has()) {
			ci('o_user_model')->remove_role($user_id, null);
			ci('o_user_model')->add_role($user_id, ci('input')->request('roles'));
		}
	}
}
