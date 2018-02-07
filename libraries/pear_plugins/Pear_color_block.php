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

pear::attach('color_block',function($color_hex) {
	return '<div style="margin-top: -4px;font-size: 120%;color:#'.trim($color_hex,'#').'"><i class="fa fa-square"></i></div>';
});
