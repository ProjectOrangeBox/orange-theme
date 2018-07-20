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
		ci('page')->data(['list'=>ci('nav_sort_library')->create_list(ci('o_nav_model')->get_as_array(1,false),config('nav.dd-list'))])->render();
	}

	public function sortPostAction() {
		ci('nav_sort_library')->process_tree_sort(ci('input')->request('tree'),1);

		ci('output')->json('html','Updated');
	}


} /* end controller */