<?php

class Filter_fupload extends Filter_base {
	public function filter(&$field, $options) {
		list($arg1,$arg2) = explode(',',$options,2);
	
		if ($value = ci('fupload')->move($arg1,$arg2)) {
			$field = $value;
		}
	}
}
