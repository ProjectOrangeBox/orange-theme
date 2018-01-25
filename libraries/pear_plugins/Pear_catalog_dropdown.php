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

class Pear_catalog_dropdown {
	protected $catalog = false;

	public function __construct() {
		ci('load')->helper('form');

		pear::attach('catalog_dropdown',function($model,$name,$value,$human_column,$primary_key='id') {
			if (!$this->catalog) {
				$this->catalog = ci($model)->catalog($primary_key,$human_column);
			}

			return form_dropdown($name,$this->catalog,$value,['class'=>'form-control select3']);
		});
	}
}
