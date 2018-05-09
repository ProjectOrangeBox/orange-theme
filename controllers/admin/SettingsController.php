<?php
/**
 * SettingsController
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

/**
 * editorAction
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
	public function editorAction($id=null) {
		$data = $this->_edit_record($id);

		$data['options'] = json_decode($data['record']->options,true);

		ci('page')->render(null,$data);
	}
}
