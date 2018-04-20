<?php

class Nav_library {
	protected $catalog;
	protected $html = '';

	protected $_navigation_open;
	protected $_navigation_close;
	protected $_item_open;
	protected $_item_open_active_class;
	protected $_item_open_dropdown_class;
	protected $_item_close;
	protected $_anchor;
	protected $_anchor_dropdown;
	protected $_dropdown_open;
	protected $_dropdown_close;

	protected $_base_url;

	public function __construct() {
		$this->catalog = ci('o_nav_model')->grouped_by_parents();

		$this->_base_url = trim(base_url(),'/');

		$config = config('nav');

		$this->_navigation_open = $config['navigation_open'];
		$this->_navigation_close = $config['navigation_close'];
		$this->_item_open = $config['item_open'];
		$this->_item_open_active_class = $config['item_open_active_class'];
		$this->_item_open_dropdown_class = $config['item_open_dropdown_class'];
		$this->_item_close = $config['item_close'];
		$this->_anchor = $config['anchor'];
		$this->_anchor_dropdown = $config['anchor_dropdown'];
		$this->_dropdown_open = $config['dropdown_open'];
		$this->_dropdown_close = $config['dropdown_close'];
	}

	public function build($parent_id) {
		$html = $this->_navigation_open;

		if (is_array($this->catalog[$parent_id])) {
			foreach ($this->catalog[$parent_id] as $item) {
				ci('event')->trigger('nav_library.build',$item);

				$html .= $this->output_Item($item);
			}
		}

		$html .= $this->_navigation_close;

		return $this->bind_user_data($html);
	}

	public function nav_permission_catalog() {
		return ci('o_permission_model')->catalog('id','key');
	}

	protected function output_Item($item) {
		$output = '';

		$classes = '';

		$output .= $this->_item_open;

		$subItems = $this->catalog[$item['id']];

		if (is_array($subItems)) {
			$classes .= $this->_item_open_dropdown_class.' ';
		}

		if (!strcmp($classes,'') == 0) {
			$output = str_replace('>',' class="' . $classes . '">',$output);
		}

		if (is_array($subItems)) {
			$output .= $this->bind_anchor($item,$this->_anchor_dropdown);
		} else {
			$output .= $this->bind_anchor($item);
		}

		if (is_array($subItems)) {
			$output .= $this->render_dropdown($subItems);
		}

		$output .= $this->_item_close;

		return $output;
	}

	protected function render_dropdown($records) {
		$output = $this->_dropdown_open;

		foreach ($records as $item) {
			$sub_output = $this->_item_open;
			$classes = '';

			if (!is_null($subItems) && count($subItems->result()) > 0){
				$classes .= $this->_item_open_dropdown_class.' ';
			}

			if (!strcmp($classes,'') == 0) {
				$sub_output = str_replace('>',' class="' . $classes . '">',$sub_output);
			}

			$output .= $sub_output;

			$output .= $this->bind_anchor($item);

			$output .= $this->_item_close;
		}

		$output .= $this->_dropdown_close;

		return $output;
	}

	protected function bind_user_data($html) {
		$vars = [
			'{username}'=>user::username(),
			'{email}'=>user::email(),
		];

		return $this->bind($html,$vars);
	}

	protected function bind_anchor($record,$is_dropdown=false) {
		$vars = [
			'{url}'=>$this->_base_url.$record['url'],
			'{text}'=>$record['text'],
			'{color}'=>$record['color'],
			'{icon}'=>$record['icon'],
			'{class}'=>$record['class'],
			'{target}'=>$record['target'],
		];

		$html = ($is_dropdown) ? $this->_anchor_dropdown : $this->_anchor;

		return $this->bind($html,$vars);
	}

	protected function bind($html,$vars) {
		ci('event')->trigger('nav_library.bind',$html,$vars);

		return strtr($html,$vars);
	}

} /* end class */
