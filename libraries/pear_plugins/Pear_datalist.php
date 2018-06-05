<?php

/* once the plug in called this will be attached to the page */
/* this adds the datalist method to pear */

class Pear_datalist {

	public function __construct() {
	ci('page')
		->js('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js')
		->css('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css')
		->domready("$('.datalist').editableSelect({effects:'fade'});");
	}

	public function render($name='',$options=[],$value='',$extras=[]) {
		$extras['class'] .= ' datalist';

		if (is_string($options)) {
			$options = ci('cache')->request->cache('catalog_datalist_'.$options,function($ci) use ($options) {
				list($model,$primary_key,$human_column) = explode('.',$options,3);
				return ci($model)->catalog($primary_key,$human_column);
			});
		}

		if (!array_key_exists($value,$options)) {
			$options[$value] = $value;
		}

		return pear::dropdown($name,$options,$value,$extras);
	}
}
