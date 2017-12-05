<?php 

class Plugin_field_human {

	public function __construct() {
		pear::attach('field_human',function($model,$field) {
			$rule = (class_exists($model,false)) ? ci()->$model->rule($field) : [];

			return (empty($rule['label'])) ? ucwords(strtolower($field)) : $rule['label'];
		});
	}

} /* end class */