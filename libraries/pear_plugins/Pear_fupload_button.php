<?php

class Pear_fupload_button {

	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/fupload/fupload.js');
	}

	public function render($name=null,$controller=null,$class='',$text='Attach') {
		return '<input type="file" id="'.$name.'" class="js-fuploader" data-url="'.$controller.'" style="display:none"><a class="btn '.$class.'" onclick="$(\'#'.$name.'\').click();">'.$text.'</a>';
	}

}
