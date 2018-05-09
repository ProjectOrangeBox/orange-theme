<?php
/**
 * RolesController
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
class RolesController extends MY_Controller {
	use admin_controller_trait;

	public $controller        = 'roles';
	public $controller_title  = 'Role';
	public $controller_titles = 'Roles';
	public $controller_path   = '/admin/roles';
	public $controller_model  = 'o_role_model';
	public $controller_order_by  = 'name';
	public $catalogs = [
		'catalog_permissions'=>['model'=>'o_permission_model','array_key'=>'id'],
	];

/**
 * detailsAction
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
	public function detailsAction($id=null) {
		if ($id) {
			$this->data = $this->_edit_record($id);
			$this->data['permissions'] = simplify_array(ci('o_role_model')->permissions((int)hex2bin($id)));
		} else {
			$this->data = $this->_new_record();
			$this->data['permissions'] = [];
		}
		ci('page')->data($this->data)->render();
	}

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
	public function indexPostAction() {
		$this->data['primary_key'] = ci('o_role_model')->insert(ci('input')->request());
		$this->_add_permissions($this->data['primary_key']);
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
	public function indexPatchAction() {
		$data = ci('input')->request();
		ci('o_role_model')->update($data);
		$this->_add_permissions($data['id']);
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
	public function indexDeleteAction() {
		ci('o_role_model')->delete(hex2bin(ci('input')->request('id')));
		if (!ci('errors')->has()) {
			ci('o_role_model')->remove_role(ci('input')->request('id'),array_keys(ci('o_role_model')->roles(ci('input')->request('id'))));
		}
		$this->_rest_output();
	}

/**
 * _add_permissions
 * Insert description here
 *
 * @param $role_id
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
	protected function _add_permissions($role_id) {
		if (!ci('errors')->has()) {
			ci('o_role_model')->remove_permission($role_id,null);
			ci('o_role_model')->add_permission($role_id,ci('input')->request('permissions'));
		}
	}
}
