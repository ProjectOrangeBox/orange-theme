<?php

class SettingsController extends MY_Controller {
	use admin_trait;

	public $controller        = 'settings';
	public $controller_title  = 'Setting';
	public $controller_titles = 'Settings';
	public $controller_path   = '/admin/settings';
	public $controller_model  = 'o_setting_model';
	public $controller_order_by = 'group,name'; /* auto order by on model */
	public $catalogs = [
		'roles_catalog'=>['model'=>'o_role_model','array_key'=>'id','select'=>'name'],
		'settings_group_catalog'=>['model'=>'o_setting_model','array_key'=>'group','select'=>'group']
	];

	public function editorAction($id=null) {
		$this->_edit_record($id);
		
		$this->page->data([
			'options'=>json_decode($this->data['record']->options),
		])->render('/admin/settings/editor');
	}

} /* end class */