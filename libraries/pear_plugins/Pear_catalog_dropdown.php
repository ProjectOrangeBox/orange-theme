<?php
ci('load')->helper('form');
/**
 * $model
 * Insert description here
 *
 * @param $name
 * @param $value
 * @param $human_column
 * @param $primary_key
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('catalog_dropdown',function($model,$name,$value,$human_column,$primary_key='id') {
	$catalog = ci('cache')->page->cache('catalog_dropdown_'.$model.$name.$human_column.$primary_key,function($ci) {
		return ci($model)->catalog($primary_key,$human_column);
	});
	return form_dropdown($name,$catalog,$value,['class'=>'form-control select3']);
});
