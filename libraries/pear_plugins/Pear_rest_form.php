<?php

class Pear_rest_form extends Pear_plugin {

	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/rest-form/rest-form.min.js');
	}

}
