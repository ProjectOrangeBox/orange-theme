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

class Pear_field_label {
	public function __construct() {
		pear::attach('field_label',function($model,$field) {
			$rule = (class_exists($model,false)) ? ci($model)->rule($field) : [];
			return '<label class="col-md-3 control-label'.((strpos('|'.$rule['rules'].'|','|required|') !== false) ? ' required' : '').'" for="textinput">'.((empty($rule['label'])) ? ucwords(strtolower($field)) : $rule['label']).'</label>';
		});
	}
}