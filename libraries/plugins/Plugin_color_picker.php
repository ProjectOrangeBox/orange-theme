<?php

class Plugin_color_picker {

	public function __construct() {
		html::attach('color_picker',function($name,$value=null,$extra=[]) {
			ci()->page
				->domready("$('.js-colorpicker').colorpicker();")
				->css('//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.1.0/css/bootstrap-colorpicker.min.css')
				->js('//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.1.0/js/bootstrap-colorpicker.min.js');

			$defaults = ['default'=>'#111111','hide_input'=>false];

			extract(array_merge($defaults, $extra));

			$value = '#'.trim(((empty($value)) ? $default : $value), '#');

			$html  = '<div class="input-group js-colorpicker">';
			$html .= '<input type="text" name="'.$name.'" value="'.$value.'" class="form-control">';
			$html .= '<span class="input-group-addon"><i></i></span>';
			$html .= '</div>';

			return $html;
		});
	}

} /* end class */