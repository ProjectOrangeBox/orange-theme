<?php
/**
 * $value
 * Insert description here
 *
 * @param
 * @param 1
 * @param $string
 * @param
 * @param $extra
 * @param
 * @param $delimiter
 * @param
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('fa_enum_icon',function($value=-1,$string = 'circle-o|check-circle-o',$extra='fa-lg',$delimiter = '|') {
	$enum = explode($delimiter,$string);
	return '<i class="fa fa-'.$enum[(int)$value].' '.$extra.'"></i>';
});
