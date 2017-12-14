<?php

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

	/* show new / edit form */
	public function detailsAction($id=null) {
		if ((int)$id > 0) {
			$this->_edit_record($id);

			$this->data['permissions'] = simple_array($this->o_role_model->permissions((int)$id));
		} else {
			$this->_new_record();
			
			$this->data['permissions'] = [];
		}

		$this->page->data($this->data)->render();
	}

	/* create a new record - REST post */
	public function indexPostAction() {
		$this->data['primary_key'] = $this->o_role_model->insert($this->input->request());

		$this->_add_permissions($this->data['primary_key']);

		$this->_rest_output();
	}

	/* update a record - REST patch */
	public function indexPatchAction() {
		$data = $this->input->request();

		$this->o_role_model->update($data);

		$this->_add_permissions($data['id']);

		$this->_rest_output();
	}

	/* delete a record - REST delete */
	public function indexDeleteAction() {
		$this->o_role_model->delete($this->input->request());

		if (!errors::has()) {
			/* first remove all of the roles */
			$this->o_role_model->remove_role($this->input->request('id'),array_keys($this->o_role_model->roles($this->input->request('id'))));
		}

		$this->_rest_output();
	}

	public function flush_aclAction() {
		delete_cache_by_tags('acl');
		
		redirect($this->controller_path);
	}

	protected function _add_permissions($role_id) {
		/* if no errors save the roles */
		if (!errors::has()) {

			/* first remove all of the roles */
			$this->o_role_model->remove_permission($role_id,null);

			/* add the new ones */
			$this->o_role_model->add_permission($role_id,$this->input->request('permissions'));
		}
	}

} /* end class */