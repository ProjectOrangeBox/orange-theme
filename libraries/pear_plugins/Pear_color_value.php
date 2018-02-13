<?php
/**
 * $color
 * Insert description here
 *
 * @param $with_hash
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('color_value',function($color,$with_hash=true) {
	return(($with_hash) ? '#' : '').trim($color, '#');
});
