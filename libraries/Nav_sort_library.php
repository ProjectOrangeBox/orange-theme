<?php

class Nav_sort_library
{
	protected $sort = 0;
	protected $config = [];

	public function __construct(&$config)
	{
	}

	/* convert tree into sort values */
	public function process_tree_sort($orders, $parent_id)
	{
		foreach ($orders as $order) {
			$this->sort = $this->sort + 3;

			ci('o_nav_model')->update(['id'=>$order['id'],'sort'=>$this->sort,'parent_id'=>$parent_id]);

			if (isset($order['children'])) {
				$this->process_tree_sort($order['children'], $order['id']);
			}
		}

		return true;
	}

	/* wrapper to return list */
	public function create_list($list, $config)
	{
		$this->config = $config;

		return $this->level($list, 1);
	}

	protected function level($list, $level)
	{
		$html .= $this->config['navigation_open'];

		foreach ($list as $value) {
			$value['disabled'] = ($value['active'] == 0) ? $this->config['item_inactive_class'] : $this->config['item_active_class'];

			$html .= quick_merge($this->config['item_open'].$this->config['content'], $value);

			if (is_array($value['children'])) {
				$html .= $this->level($value['children'], ($level + 1));
			}

			$html .= $this->config['item_close'];
		}

		$html .= $this->config['navigation_close'];

		return $html;
	}
} /* end class */
