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

class Pear_new_button {
	public function __construct() {
		pear::attach('new_button',function($uri='',$title='New',$attributes=[]) {
			$default_attributes = ['class'=>'btn btn-default btn-sm js-new'];
			$attributes = array_merge($default_attributes,(array)$attributes);
			return anchor($uri,'<i class="fa fa-magic" aria-hidden="true"></i> '.$title,$attributes);
		});
	}
}