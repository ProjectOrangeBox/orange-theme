<?php
/**
 * $string
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
pear::attach('e',function($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
});
