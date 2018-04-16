<?php

class Pear_e {

	public function render($string=null) {
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
}
