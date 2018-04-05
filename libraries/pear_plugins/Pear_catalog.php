<?php

ci('load')->helper('form');

pear::attach('catalog_lookup',function($model,$value,$human_column,$primary_key='id') {
	$catalog = ci('cache')->page->cache('catalog_lookup'.$model.$human_column.$primary_key,function($ci) {
		return ci($model)->catalog($primary_key,$human_column);
	});
	return $catalog[$value];
});

pear::attach('catalog_dropdown',function($model,$name,$value,$human_column,$primary_key='id') {
	$catalog = ci('cache')->page->cache('catalog_dropdown_'.$model.$name.$human_column.$primary_key,function($ci) {
		return ci($model)->catalog($primary_key,$human_column);
	});
	return form_dropdown($name,$catalog,$value,['class'=>'form-control select3']);
});
