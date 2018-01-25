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

class Pear_catalog_lookup {
	protected $catalog = false;

	public function __construct() {
		pear::attach('catalog_lookup',function($model,$value,$human_column,$primary_key='id') {
			if (!$this->catalog) {
				$this->catalog = ci($model)->catalog($primary_key,$human_column);
			}

			return $this->catalog[$value];
		});
	}
}
