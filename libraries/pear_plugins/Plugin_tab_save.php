<?php

class Plugin_tab_save {

	public function __construct() {
		ci()->page->js('/theme/orange/assets/plugins/orange-tab-save/orange-tab-save.min.js');
	}

} /* end class */