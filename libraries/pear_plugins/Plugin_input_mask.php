<?php

class Plugin_input_mask {

	public function __construct() {
		ci()->page->js('/theme/orange/assets/plugins/input_mask/input-mask.min.js');
	}

} /* end class */