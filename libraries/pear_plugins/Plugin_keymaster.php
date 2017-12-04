<?php

class Plugin_keymaster {

	public function __construct() {
		ci()->page->js([
			'//cdnjs.cloudflare.com/ajax/libs/keymaster/1.6.1/keymaster.min.js',
			'/theme/orange/assets/plugins/keymaster/onready_keymaster.min.js'
		]);
	}

} /* end class */