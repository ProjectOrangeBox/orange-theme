<?php

class Pear_tab_save extends Pear_plugin {

	public function __construct() {
		/* provides saving the last selected tab for a give html page */
		ci('page')->js('/theme/orange/assets/plugins/orange-tab-save/orange-tab-save.min.js');
	}

}
