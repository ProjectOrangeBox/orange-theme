<?php

class Pear_money extends Pear_plugin {

	public function render($number=null) {
		return money_format('$%i',$number);
	}

}
