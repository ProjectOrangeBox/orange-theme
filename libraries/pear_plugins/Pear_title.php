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

class Pear_title {
	public function __construct() {
		pear::attach('title',function($title,$icon=null) {
			return '<h3>'.(($icon) ? '<i class="fa fa-'.$icon.'"></i> '.$title : $title).'</h3>';
		});
	}
}