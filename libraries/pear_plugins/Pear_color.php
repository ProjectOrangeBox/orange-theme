<?php
pear::attach('color_block',function($color_hex) {
	return '<div style="margin-top: -4px;font-size: 120%;color:#'.trim($color_hex,'#').'"><i class="fa fa-square"></i></div>';
});

pear::attach('color_picker',function($name,$value=null,$extra=[]) {
	ci('page')
		->domready("$('.js-colorpicker').colorpicker();")
		->css('//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.1.0/css/bootstrap-colorpicker.min.css')
		->js('//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.1.0/js/bootstrap-colorpicker.min.js');
	$extra = array_merge(['default'=>'#111111'], $extra);
	$value = '#'.trim(((empty($value)) ? $extra['default'] : $value), '#');
	return '<div class="input-group js-colorpicker"><input type="text" name="'.$name.'" value="'.$value.'" class="form-control"><span class="input-group-addon"><i></i></span></div>';
});

pear::attach('color_value',function($color,$with_hash=true) {
	return(($with_hash) ? '#' : '').trim($color, '#');
});
