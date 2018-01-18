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

class Pear_datalist {
	public function __construct() {
			ci('page')
				->js('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js')
				->css('//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css')
				->domready("$('.datalist').editableSelect({effects:'fade'});");

		pear::attach('datalist',function($name='',$options=[],$value='',$extras=[]) {
			$extras['class'] .= ' datalist';

 			return pear::dropdown($name,$options,$value,$extras);
		});
	}
}
