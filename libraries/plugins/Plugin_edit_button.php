<?php 

class Plugin_edit_button {

	public function __construct() {
		html::attach('edit_button',function($uri='',$attributes=[]) {
			return anchor($uri,'<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>',$attributes);
		});
	}
	
} /* end class */

