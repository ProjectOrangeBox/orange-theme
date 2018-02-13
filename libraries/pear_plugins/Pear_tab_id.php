<?php
/**
 * $value
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
pear::attach('tab_id',function($value) {
	return md5($value);
});
