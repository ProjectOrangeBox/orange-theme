<?php
/**
 *
 * ComboBox
 *
 * pear::datalist($name,$value,$options,$extras)
 *
 * there are no extras supported by datalist
 * so this is currently just passed to pear::dropdown(...)
 *
 */
 class Pear_datalist
 {
	 public function __construct()
	 {
		 ci('page')
		->js('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js')
		->css('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css')
		->domready("$('.datalist').editableSelect({effects:'fade'});");
	 }

	 public function render($name='', $value='', $options=[], $extras=[])
	 {
		 $extras['class'] .= ' datalist';

		 if (!array_key_exists($value, $options)) {
			 $options[$value] = $value;
		 }

		 return pear::dropdown($name, $options, $value, $extras);
	 }
 }
