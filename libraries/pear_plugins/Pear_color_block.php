<?php
/**
 * $color_hex
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
pear::attach('color_block',function($color_hex) {
	return '<div style="margin-top: -4px;font-size: 120%;color:#'.trim($color_hex,'#').'"><i class="fa fa-square"></i></div>';
});
