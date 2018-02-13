<?php
/**
 * $model
 * Insert description here
 *
 * @param $field
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('field_label',function($model,$field) {
	$rule = (class_exists($model,false)) ? ci($model)->rule($field) : [];
	return '<label class="col-md-3 control-label'.((strpos('|'.$rule['rules'].'|','|required|') !== false) ? ' required' : '').'" for="textinput">'.((empty($rule['label'])) ? ucwords(strtolower($field)) : $rule['label']).'</label>';
});
