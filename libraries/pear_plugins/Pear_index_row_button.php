<?php

class Pear_index_row_button extends Pear_plugin {

	public function __construct() {
		ci('load')->helper('url');
	}

	public function render($uri='',$icon='',$attributes=[]) {
		return anchor($uri,'<i class="fa fa-'.$icon.' fa-lg" aria-hidden="true"></i>',(array)$attributes);
	}
}
