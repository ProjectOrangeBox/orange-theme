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

	public function detailsAction($id=null) {
		if ($id) {
			$this->_edit_record($id);

			$this->data['permissions'] = simplify_array(ci('o_role_model')->permissions((int)hex2bin($id)));
		} else {
			$this->_new_record();

			$this->data['permissions'] = [];
		}

		ci('page')->data($this->data)->render();
	}

	public function indexPostAction() {
		$this->data['primary_key'] = ci('o_role_model')->insert(ci('input')->request());

		$this->_add_permissions($this->data['primary_key']);

		$this->_rest_output();
	}

	public function indexPatchAction() {
		$data = ci('input')->request();

		ci('o_role_model')->update($data);

		$this->_add_permissions($data['id']);

		$this->_rest_output();
	}

	public function indexDeleteAction() {
		ci('o_role_model')->delete(hex2bin(ci('input')->request('id')));

		if (!ci('errors')->has()) {
			ci('o_role_model')->remove_role(ci('input')->request('id'),array_keys(ci('o_role_model')->roles(ci('input')->request('id'))));
		}

		$this->_rest_output();
	}

	protected function _add_permissions($role_id) {
		if (!ci('errors')->has()) {
			ci('o_role_model')->remove_permission($role_id,null);

			ci('o_role_model')->add_permission($role_id,ci('input')->request('permissions'));
		}
	}
}
