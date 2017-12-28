<?php

class SettingsController extends MY_Controller {
	use admin_controller_trait;

	public $controller        = 'settings';
	public $controller_title  = 'Setting';
	public $controller_titles = 'Settings';
	public $controller_path   = '/admin/settings';
	public $controller_model  = 'o_setting_model';
	public $controller_order_by = 'group,name'; /* auto order by on model */
	public $catalogs = [
		'settings_group_catalog'=>['model'=>'o_setting_model','array_key'=>'group','select'=>'group']
	];

	public function editorAction($id=null) {
		/* do the standard load the record */
		$this->_edit_record(hex2bin($id));
		
		/* grab the record data load in the previous step */
		$record = $this->load->get_var('record');
		
		/* decode the json for the options */
		$this->page->data(['options'=>json_decode($record->options,true)])->render('/admin/settings/editor');
	}

} /* end class */