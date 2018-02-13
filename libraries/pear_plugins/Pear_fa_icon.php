<?php
/**
 * $name
 * Insert description here
 *
 * @param
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('fa_icon',function($name='') {
	return '<i class="fa fa-'.$name.'"></i>';
});
