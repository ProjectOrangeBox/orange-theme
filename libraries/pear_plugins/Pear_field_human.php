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

class Pear_field_human {
	public function __construct() {
		pear::attach('field_human',function($model,$field) {
			$rule = (class_exists($model,false)) ? ci($model)->rule($field) : [];
			return (empty($rule['label'])) ? ucwords(strtolower($field)) : $rule['label'];
		});
	}
}
