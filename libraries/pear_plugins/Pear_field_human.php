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
pear::attach('field_human',function($model,$field) {
	$rule = (class_exists($model,false)) ? ci($model)->rule($field) : [];
	return (empty($rule['label'])) ? ucwords(strtolower($field)) : $rule['label'];
});
