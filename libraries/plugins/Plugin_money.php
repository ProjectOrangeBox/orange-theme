<?php 

class Plugin_money {

	public function __construct() {
		plugin::attach('money',function($number) {
			return money_format('$%i',$number);
		});
	}

} /* end class */