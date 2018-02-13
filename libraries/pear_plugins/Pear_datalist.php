<?php
ci('page')
	->js('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js')
	->css('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css')
	->domready("$('.datalist').editableSelect({effects:'fade'});");
/**
 * $name
 * Insert description here
 *
 * @param
 * @param $options
 * @param
 * @param $value
 * @param
 * @param $extras
 * @param
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('datalist',function($name='',$options=[],$value='',$extras=[]) {
	$extras['class'] .= ' datalist';
	if (is_string($options)) {
/**
 * $ci
 * Insert description here
 *
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
		$options = ci('cache')->page->cache('catalog_datalist_'.$options,function($ci) use ($options) {
			list($model,$primary_key,$human_column) = explode('.',$options,3);
			return ci($model)->catalog($primary_key,$human_column);
		});
	}
	if (!array_key_exists($value,$options)) {
		$options[$value] = $value;
	}
	return pear::dropdown($name,$options,$value,$extras);
});
