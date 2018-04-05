<?php

ci('page')
	->js('/theme/orange/assets/plugins/form-tools/onready_form_tools.min.js')
	->js('//gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js')
	->css('//gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css');

pear::attach('form_help',function($string) {
	return '<p class="help-block">'.htmlspecialchars($string, ENT_QUOTES, 'UTF-8').'</p>';
});

pear::attach('form_static',function($string) {
	return '<p class="form-control-static">'.htmlspecialchars($string, ENT_QUOTES, 'UTF-8').'</p>';
});
