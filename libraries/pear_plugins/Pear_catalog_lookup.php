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

pear::attach('catalog_lookup',function($model,$value,$human_column,$primary_key='id') {
	$catalog = ci('cache')->page->cache('catalog_lookup'.$model.$human_column.$primary_key,function($ci) {
		return ci($model)->catalog($primary_key,$human_column);
	});

	return $catalog[$value];
});
