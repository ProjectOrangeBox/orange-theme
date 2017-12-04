<?php 

class Plugin_money {

	public function __construct() {
		pear::attach('money',function($number) {
			return money_format('$%i',$number);
		});
	}

} /* end class */