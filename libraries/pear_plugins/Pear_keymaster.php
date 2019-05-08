<?php

class Pear_keymaster extends \Pear_plugin
{
	public function __construct()
	{
		ci('page')->js([
			'//cdnjs.cloudflare.com/ajax/libs/keymaster/1.6.1/keymaster.min.js',
			'/theme/orange/assets/plugins/keymaster/onready_keymaster'.PAGE_MIN.'.js',
		]);
	}
}
