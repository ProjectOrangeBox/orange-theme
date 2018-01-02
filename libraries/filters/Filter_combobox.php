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

class Filter_combobox extends Filter_base {
	public function filter(&$field, $options) {
		$field = $this->field_data[$options];
	}
}