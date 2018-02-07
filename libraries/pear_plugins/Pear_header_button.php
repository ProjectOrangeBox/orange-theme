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

pear::attach('header_button',function($uri='',$title='',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm'];
	$attributes = array_merge($default_attributes,(array)$attributes);

	return anchor($uri,'<i class="fa fa-'.$attributes['icon'].'" aria-hidden="true"></i> '.$title,$attributes);
});
