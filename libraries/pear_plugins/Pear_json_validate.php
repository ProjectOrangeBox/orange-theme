<?php

class Pear_json_validate extends Pear_plugin {

	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/json-field-validate/json-field-validate.min.js');
	}

}

