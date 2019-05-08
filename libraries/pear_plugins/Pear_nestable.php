<?php

class Pear_nestable extends \Pear_plugin
{
	public function __construct()
	{
		ci('page')
			->js_variable('nestable_handler', ci('page')->data('nestable_handler'))
			->domready('plugins.nestable.init();')
			->js([
				'/theme/orange/assets/plugins/nestable/nestable'.PAGE_MIN.'.js',
				'//cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js'
				])->css('/theme/orange/assets/plugins/nestable/nestable'.PAGE_MIN.'.css');
	}
}
