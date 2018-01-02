<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
 * <?=pear::dropdown('read_role_id',$roles_catalog,$record->read_role_id,['class'=>'form-control select3']) ?>
 */

class Pear_role_dropdown {
	public function __construct() {
		pear::attach('role_dropdown',function($name,$value) {
			return pear::dropdown($name,ci('o_role_model')->catalog('id','name'),$value,['class'=>'form-control select3']);
		});
	}
}