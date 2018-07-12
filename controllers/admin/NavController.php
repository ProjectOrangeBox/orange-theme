<?php
/**
* Orange Framework Extension
*
* This content is released under the MIT License (MIT)
*
* @package	CodeIgniter / Orange
* @author	Don Myers
* @license http://opensource.org/licenses/MIT MIT License
* @link	https://github.com/ProjectOrangeBox
*/

class NavController extends MY_Controller {
	use admin_controller_trait;

	public $controller        = 'nav';
	public $controller_path   = '/admin/nav';
	public $controller_model  = 'o_nav_model';
	public $controller_title  = 'Menu';
	public $controller_titles = 'Menus';
	public $controller_order_by = 'sort';

	public function sortAction() {
		ci('page')->data(['list'=>ci('nav_library')->gui_compress(ci('o_nav_model')->ol_list(1))])->render();
	}

	public function sortPostAction() {
		ci('nav_library')->gui_expand(ci('input')->request('tree'),1);

		ci('output')->json('html','Updated');
	}


} /* end controller */