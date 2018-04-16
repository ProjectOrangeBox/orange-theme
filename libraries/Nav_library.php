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
	protected $_current_url;
	protected $_base_url;

	public function __construct() {
		$this->catalog = cache('nav_library.'.ci('o_nav_model')->get_cache_prefix().'.user'.user::id(),function() {
			return ci('o_nav_model')->grouped_by_parents();
		});

		$this->_current_url = rtrim(current_url(),'/');

		$this->_base_url = base_url();

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
				$html .= $this->outputItem($item);
			}
		}

		$html .= $this->_navigation_close;

		return $html;
	}

	public function nav_bar($brand,$start_left_id,$start_right_id) {
		$html  = '<nav class="navbar navbar-inverse navbar-fixed-top">';
		$html .= '<div class="container">';
		$html .= '<div class="navbar-header">';
		$html .= '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">';
		$html .= '<span class="sr-only">Toggle</span>';
		$html .= '<span class="icon-bar"></span>';
		$html .= '<span class="icon-bar"></span>';
		$html .= '<span class="icon-bar"></span>';
		$html .= '</button>';
		$html .= '<a class="navbar-brand" href="'.$brand['url'].'">'.$brand['text'].'</a>';
		$html .= '</div>';
		$html .= '<div id="navbar" class="navbar-collapse collapse">';
		$html .= '<ul class="nav navbar-nav">';
		$html .= $this->build($start_left_id);
		$html .= '</ul>';
		$html .= '<ul class="nav navbar-nav navbar-right">';
		$html .= $this->build($start_right_id);
		$html .= '</ul>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</nav>';

		return $html;
	}

	public function isCurrentPage($url) {
		$page_url = str_replace(rtrim($this->_base_url,'/'),'',$this->_current_url);

		if (empty($page_url)) {
			$page_url = '/';
		}

		return strcmp('/'.$url,$page_url) == 0;
	}

		public function bindAnchor($url, $text, $extra = '',$isDropdown = false) {
			$vars = [
					'{$url}' => $this->_base_url.$url,
					'{$text}' => $text,
					'{$extra}' => $extra
			];

			return ($isDropdown) ? strtr($this->_anchor_dropdown,$vars) : strtr($this->_anchor, $vars);
		}

		public function outputItem($item) {
			$output = '';

			$classes = '';

			$output .= $this->_item_open;

			$subItems = $this->catalog[$item['id']];

			if ($this->isCurrentPage($item['url'])) {
				$classes .= $this->_item_open_active_class.' ';
			}

			if (is_array($subItems)) {
				$classes .= $this->_item_open_dropdown_class.' ';
			}

			if (!strcmp($classes,'') == 0) {
				$output = str_replace('>',' class="' . $classes . '">',$output);
			}

			if (is_array($subItems)) {
				$output .= $this->bindAnchor($item['url'],$item['text'],'',$this->_anchor_dropdown);
			} else {
				$output .= $this->bindAnchor($item['url'],$item['text']);
			}

			if (is_array($subItems)) {
				$output .= $this->renderDropdown($subItems);
			}

			$output .= $this->_item_close;

			return $output;
		}

		public function renderDropdown($records) {
			$output = $this->_dropdown_open;

			foreach ($records as $item) {
				$subOutput = $this->_item_open;
				$classes = '';

				if ($this->isCurrentPage($item['url'])) {
					$classes .= $this->_item_open_active_class.' ';
				}

				if (!is_null($subItems) && count($subItems->result()) > 0){
					$classes .= $this->_item_open_dropdown_class.' ';
				}

				if (!strcmp($classes,'') == 0) {
					$subOutput = str_replace('>',' class="' . $classes . '">',$subOutput);
				}

				$output .= $subOutput;

				$output .= $this->bindAnchor($item['url'], $item['text']);

				$output .= $this->_item_close;
			}

			$output .= $this->_dropdown_close;

			return $output;
		}



} /* end class */