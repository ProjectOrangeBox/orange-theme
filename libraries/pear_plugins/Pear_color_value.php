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

pear::attach('color_value',function($color,$with_hash=true) {
	return(($with_hash) ? '#' : '').trim($color, '#');
});
