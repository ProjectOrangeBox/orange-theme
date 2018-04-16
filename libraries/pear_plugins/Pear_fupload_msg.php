<?php

class Pear_fupload_msg {

	public function render($name='',$value='',$class='') {
		return '<span id="'.$name.'-msg" class="'.$class.'">'.basename($value).'</span><input type="hidden" id="'.$name.'-hidden" name="'.$name.'" value="'.$value.'">';
	}

}
