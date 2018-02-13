<?php
/**
 * $number
 * Insert description here
 *
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('money',function($number) {
	return money_format('$%i',$number);
});
