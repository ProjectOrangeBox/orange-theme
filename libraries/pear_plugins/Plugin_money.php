<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
 */

class Plugin_money {
	public function __construct() {
		pear::attach('money',function($number) {
			return money_format('$%i',$number);
		});
	}
}