<?php

class Pear_notify extends \Pear_plugin
{
	public function __construct() {
		ci('page')
			->css('/theme/orange/assets/plugins/notify/notify'.PAGE_MIN.'.css')
			->js('/theme/orange/assets/plugins/notify/notify'.PAGE_MIN.'.js');
	}
}
