<?php

class Pear_notify extends \Pear_plugin
{
	public function __construct() {
		ci('page')
			->css('/theme/orange/assets/plugins/notify/notify.min.css')
			->js('/theme/orange/assets/plugins/notify/notify.min.js');
	}
}
