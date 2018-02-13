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
pear::attach('tab_title',function($string) {
	return htmlspecialchars(ucwords($string), ENT_QUOTES, 'UTF-8');
});
