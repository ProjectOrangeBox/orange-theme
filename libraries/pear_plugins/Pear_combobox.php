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

class Pear_combobox {
	public function __construct() {
		pear::attach('combobox',function($name=null,$value=null,$options=[],$extra=[]) {
			ci('page')
				->js('/theme/orange/assets/plugins/combobox/bootstrap3-typeahead.min.js')
				->css('/theme/orange/assets/plugins/combobox/o-bootstrap3-typeahead.min.css');
			asort($options);
			$html  = '<div class="inner-addon right-addon">';
			$html .= '<input type="text" name="'.$name.'" id="id-'.$name.'" class=" form-control" value="'.esc($value).'" autocomplete="off">';
			$html .= '<span class="bs-caret"><i class="fa fa-plus-square"></i></span>';
			$html .= '</div>';
			$html .= '<script>document.addEventListener("DOMContentLoaded",function(e){$("#id-'.$name.'").typeahead({';
			$html .= 'showHintOnFocus: true,';
			$html .= 'items: "all",';
			$html .= 'source: ["'.implode('","',$options).'"]';
			$html .= '});';
			$html .= '});';
			$html .= '</script>';
			return $html;
		});
	}
}