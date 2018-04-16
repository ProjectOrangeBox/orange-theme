<?php

class Pear_fupload {

	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/fupload/fupload.js');
	}

	public function render($name=null,$controller=null,$class='') {
		return '<input type="file" id="'.$name.'" class="js-fuploader" data-url="'.$controller.'" style="display:none"><a class="btn '.$class.'" onclick="$(\'#'.$name.'\').click();">Attach</a>';
	}

}
