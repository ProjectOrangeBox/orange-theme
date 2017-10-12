<?php

class Plugin_confirm_dialog {

	public function __construct() {
		ci()->page->js('/theme/orange/assets/plugins/confirm-dialog/config-dialog.min.js');
	}

} /* end class */