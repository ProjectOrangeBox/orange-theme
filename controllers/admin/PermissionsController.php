<?php 

class PermissionsController extends MY_Controller {
	use admin_trait;

	public $controller        = 'permissions';
	public $controller_title  = 'Permission';
	public $controller_titles = 'Permissions';
	public $controller_path   = '/admin/permissions';
	public $controller_model  = 'o_permission_model';
	public $controller_order_by = 'key'; /* auto order by on model */
	public $catalogs = [
		'permissions_group_catalog'=>['model'=>'o_permission_model','array_key'=>'group','select'=>'group'],
	];

	public function debugAction() {
		$this->page->data(['users'=>$this->o_user_model->get_many()])->render('admin/permissions/permissions');
	}
	
} /* end class */