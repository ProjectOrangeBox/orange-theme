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
 * @version 2.0
 *
 * required
 * core:
 * libraries:
 * models:
 * helpers:
 * functions:
 *
 */
class UsersController extends MY_Controller {
	public $controller        = 'users';
	public $controller_title  = 'User';
	public $controller_titles = 'Users';
	public $controller_path   = '/users';
	public $controller_model  = 'o_user_model';

/**
 * edit_profileAction
 * Insert description here
 *
 * @param $id
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
	public function edit_profileAction($id=null) {
		ci('validate')->variable(ci('o_user_model')->rule(ci('o_user_model')->get_primary_key(),'rules'),$id)->die_on_fail();
		
		if (ci('user')->id !== $id) {
			ci('errors')->display('general',['heading'=>'Error','message'=>'The User ID is unknown.']);
		}
		
		ci('page')->data(['record'=>ci('o_user_model')->get($id),'form_method'=>'patch'])->render();
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
	public function indexPatchAction() {
		$data = ci('input')->request();
		
		if (ci('input')->request('confirm_password') != ci('input')->request('password')) {
			ci('errors')->add('Your Passwords do not match.');
		} else {
			if (empty($data['password'])) {
				unset($data['password']);
			}
			ci('o_user_model')->update($data);
		}
		
		$this->_rest_output();
	}
}
