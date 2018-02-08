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
	$catalog = ci('cache')->page->cache('catalog_dropdown_'.$model.$name.$human_column.$primary_key,function($ci) {
		return ci($model)->catalog($primary_key,$human_column);
	});

	return form_dropdown($name,$catalog,$value,['class'=>'form-control select3']);
});
