<?php

class Pear_form_tools {

	public function __construct() {
		ci('page')
			->js(['/theme/orange/assets/plugins/form-tools/onready_form_tools'.PAGE_MIN.'.js','//gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle'.PAGE_MIN.'.js'])
			->css('//gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle'.PAGE_MIN.'.css');
	}

}
