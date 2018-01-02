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

class PermissionsController extends MY_Controller {
	use admin_controller_trait;
	public $controller        = 'permissions';
	public $controller_title  = 'Permission';
	public $controller_titles = 'Permissions';
	public $controller_path   = '/admin/permissions';
	public $controller_model  = 'o_permission_model';
	public $controller_order_by = 'key';
	public $catalogs = [
		'permissions_group_catalog'=>['model'=>'o_permission_model','array_key'=>'group','select'=>'group'],
	];
}