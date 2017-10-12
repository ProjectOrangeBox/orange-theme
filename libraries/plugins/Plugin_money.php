<?php 

class Plugin_money {

	public function __construct() {
		html::attach('money',function($number) {
			return money_format('$%i',$number);
		});
	}

} /* end class */