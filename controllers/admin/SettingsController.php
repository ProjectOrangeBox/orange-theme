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

class SettingsController extends MY_Controller {
	use admin_controller_trait;

	public $controller        = 'settings';
	public $controller_title  = 'Setting';
	public $controller_titles = 'Settings';
	public $controller_path   = '/admin/settings';
	public $controller_model  = 'o_setting_model';
	public $controller_order_by = 'group,name';
	public $catalogs = [
		'settings_group_catalog'=>['model'=>'o_setting_model','array_key'=>'group','select'=>'group'],
	];

	public function editorAction($id=null) {
		$this->_edit_record(hex2bin($id));

		$record = ci('load')->get_var('record');

		ci('page')->data(['options'=>json_decode($record->options,true)])->render('/admin/settings/editor');
	}
}