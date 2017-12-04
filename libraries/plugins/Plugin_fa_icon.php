<?php

class Plugin_fa_icon {

	public function __construct() {
		plugin::attach('fa_icon',function($name='') {
			return '<i class="fa fa-'.$name.'"></i>';
		});
	}

} /* end class */