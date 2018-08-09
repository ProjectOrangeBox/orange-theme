<?php

class Nav_library {
	protected $base_url;
	protected $config = [];

	public function __construct(&$config) {
		$this->config = &$config;
	}

	/* build HTML for main menu */
	public function build_bootstrap_nav($parent_id,$config,$filter=true) {
		$cache_key = (ci('o_nav_model')->get_cache_prefix()).'.build_bootstrap_nav.'.md5(json_encode(func_get_args()));

		$user_permissions = array_keys(ci('user')->permissions());

		if ($filter) {
			$cache_key .= '.'.md5(json_encode($user_permissions));
		}

		if (!$html = ci('cache')->get($cache_key)) {
			$this->config = $config;

			$this->base_url = trim(base_url(),'/');

			$html = $this->config['navigation_open'];

			$menus = ($filter) ? ci('o_nav_model')->get_filtered($parent_id,$user_permissions) : ci('o_nav_model')->get_unfiltered($parent_id);

			if (is_array($menus)) {
				foreach ($menus as $menu) {
					$html .= $this->item($menu,1);
				}
			}

			$html .= $this->config['navigation_close'];

			ci('cache')->save($cache_key,$html,cache_ttl());
		}

		ci('event')->trigger('nav.library.html',$html);

		return $html;
	}

	protected function item($item,$level) {
		$html = '';

		/* does this menu have any children? */
		if (isset($item['children'])) {
			if ($level == 1) {
				$html .= $this->config['item_open_dropdown'];
			} else {
				$html .= $this->config['item_open_dropdown_sub'];
			}

			$html .= ci('parser')->parse_string($this->config['anchor_dropdown'],$item,true);

			$html .= $this->config['dropdown_open'];

			foreach ($item['children'] as $i) {
				$html .= $this->item($i,($level + 1));
			}

			$html .= $this->config['dropdown_close'];

			$html .= $this->config['item_close_dropdown'];
		} else {
			if ($item['text'] == '{hr}') {
				$html .= $this->config['hr'];
			} else {
				$html .= $this->config['item_open'];
				$html .= ci('parser')->parse_string($this->config['anchor'],$item,true);
				$html .= $this->config['item_close'];
			}
		}

		return $html;
	}

} /* end class */
