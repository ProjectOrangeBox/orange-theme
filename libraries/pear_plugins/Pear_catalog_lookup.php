<?php
/**
 * $model
 * Insert description here
 *
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
pear::attach('catalog_lookup',function($model,$value,$human_column,$primary_key='id') {
	$catalog = ci('cache')->page->cache('catalog_lookup'.$model.$human_column.$primary_key,function($ci) {
		return ci($model)->catalog($primary_key,$human_column);
	});
	return $catalog[$value];
});
