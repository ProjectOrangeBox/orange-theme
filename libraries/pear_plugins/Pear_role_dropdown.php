<?php
/**
 * $name
 * Insert description here
 *
 * @param $value
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('role_dropdown',function($name,$value) {
	if ($value === null) {
		$prop = 'user_'.explode('_',$name)[0].'_role_id';
		$value = ci('user')->$prop;
	}
	return pear::dropdown($name,ci('o_role_model')->catalog('id','name'),$value,['class'=>'form-control select3']);
});
