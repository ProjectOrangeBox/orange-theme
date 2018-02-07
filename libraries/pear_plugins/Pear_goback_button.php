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

pear::attach('goback_button',function($uri='',$title='Go Back',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm js-esc'];
	$attributes = array_merge($default_attributes,(array)$attributes);

	return anchor($uri,'<i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i> '.$title,$attributes);
});
