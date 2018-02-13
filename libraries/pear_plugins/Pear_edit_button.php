<?php
/**
 * $uri
 * Insert description here
 *
 * @param
 * @param $attributes
 * @param
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('edit_button',function($uri='',$attributes=[]) {
	return anchor($uri,'<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>',$attributes);
});
