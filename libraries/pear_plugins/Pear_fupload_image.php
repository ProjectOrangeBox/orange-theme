<?php

class Pear_fupload_image {

	public function render($name='',$value='',$class='') {
		return '<img src="'.$value.'" id="'.$name.'-preview" class="'.$class.'">';
	}

}
