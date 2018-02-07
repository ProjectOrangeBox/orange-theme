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
	global $pear_catalog_lookup_catalog;

	if (!$pear_catalog_lookup_catalog) {
		$pear_catalog_lookup_catalog = ci($model)->catalog($primary_key,$human_column);
	}

	return $pear_catalog_lookup_catalog[$value];
});
