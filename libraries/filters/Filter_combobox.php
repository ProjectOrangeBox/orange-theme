<?php
/**
 * Orange Framework validation rule
 *
 * This content is released under the MIT License (MIT)
 *
 * @package	CodeIgniter / Orange
 * @author	Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link	https://github.com/ProjectOrangeBox
 *
 */
class Filter_combobox extends Filter_base {

	/*
	convert field value to primary id or create a new entry
	
	combobox_filter[model,primary,column]
	*/
	public function filter(&$field, $options) {
		$field = $this->field_data[$options];

		return true;
	}

} /* end class */