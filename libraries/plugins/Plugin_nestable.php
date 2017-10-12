<?php

class Plugin_nestable {

	public function __construct() {
		ci()->page
			->js_variables('nestable_handler', ci()->page->data('nestable_handler'))
			->domready('plugins.nestable.init();')
			->js(['/theme/orange/assets/plugins/nestable/nestable.js','/theme/orange/assets/plugins/nestable/vendor/jquery.nestable.min.js'])
			->css('/theme/orange/assets/plugins/nestable/nestable.min.css');
	}

} /* end class */