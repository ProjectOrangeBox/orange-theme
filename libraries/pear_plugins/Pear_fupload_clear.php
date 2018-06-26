<?php

class Pear_fupload_clear {

	public function render($name='',$value='',$class='',$text='Remove') {
		return '<a id="'.$name.'-remove-btn" data-id="'.$name.'" class="js-fupload-remove btn '.$class.'"'.((empty($value)) ? ' style="display:none"' : '').'>'.$text.'</a>';
	}

}
