<?php

class Pear_catalog_lookup extends Pear_plugin {

	public function __construct() {
		ci('load')->helper('form');
	}

	public function render($model=null,$value=null,$human_column=null,$primary_key='id') {
		$catalog = ci('cache')->request->cache('catalog_lookup'.$model.$human_column.$primary_key,function($ci) use ($model,$human_column,$primary_key) {
			return ci($model)->catalog($primary_key,$human_column);
		});

		return $catalog[$value];
	}
}
