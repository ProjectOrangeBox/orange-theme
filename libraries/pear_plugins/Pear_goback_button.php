<?php
/**
 * $uri
 * Insert description here
 *
 * @param
 * @param $title
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
pear::attach('goback_button',function($uri='',$title='Go Back',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm js-esc'];
	$attributes = array_merge($default_attributes,(array)$attributes);
	return anchor($uri,'<i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i> '.$title,$attributes);
});
