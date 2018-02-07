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

ci('load')->helper('form');

pear::attach('catalog_dropdown',function($model,$name,$value,$human_column,$primary_key='id') {
	global $pear_catalog_dropdown_catalog;

	if (!$pear_catalog_dropdown_catalog) {
		$pear_catalog_dropdown_catalog = ci($model)->catalog($primary_key,$human_column);
	}

	return form_dropdown($name,$pear_catalog_dropdown_catalog,$value,['class'=>'form-control select3']);
});
