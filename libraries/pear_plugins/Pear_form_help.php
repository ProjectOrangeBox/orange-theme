<?php

class Pear_form_help {

	public function render($string='') {
		return '<p class="help-block">'.htmlspecialchars($string, ENT_QUOTES, 'UTF-8').'</p>';
	}

}
