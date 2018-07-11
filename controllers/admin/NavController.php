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

	public $list = '';
	public $sort = 0;

	public function sortAction() {
		ci('page')->data(['list'=>$this->compress(ci('o_nav_model')->ol_list(1))])->render();
	}

	public function sortPostAction() {
		$this->expand(ci('input')->request('tree'),1);

		ci('output')->json('html','Updated');
	}

	protected function expand($orders,$parent_id) {
		foreach ($orders as $order) {
			$this->sort = $this->sort + 3;

			ci('o_nav_model')->update(['id'=>$order['id'],'sort'=>$this->sort,'parent_id' => $parent_id]);

			if (isset($order['children'])) {
				$this->expand($order['children'],$order['id']);
			}
		}
		
		return true;
	}

	protected function compress($list) {
		$this->_compress($list);

		return $this->list;
	}

	protected function _compress($list) 	{
		$this->list .= '<ol class="dd-list">';

		foreach ($list as $value) {
			$disabled = ($value['active'] == 0) ? 'text-muted' : '';

			$this->list .= '<li class="panel-default dd-item dd3-item" data-id="'.$value['id'].'">';
			$this->list .= '<div class="btn-primary dd-handle dd3-handle">Drag</div>';
			$this->list .= '<div class="btn btn-default dd3-content">';
			$this->list .= '<span class="'.$disabled.'">'.$value['text'].'<small>'.$value['url'].'</small></span>';
			$this->list .= '</div>';

			if (is_array($value['children'])) {
				$this->_compress($value['children']);
			}

			$this->list .= '</li>';
		}

		$this->list .= '</ol>';
	}

} /* end controller */