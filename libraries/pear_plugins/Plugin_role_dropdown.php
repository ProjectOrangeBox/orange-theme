<?php 

/*
<?=pear::dropdown('read_role_id',$roles_catalog,$record->read_role_id,['class'=>'form-control select3']) ?>
*/

class Plugin_role_dropdown {

	public function __construct() {
		pear::attach('role_dropdown',function($name,$value) {
			return pear::dropdown($name,ci()->o_role_model->catalog('id','name'),$value,['class'=>'form-control select3']);
		});
	}
	
} /* end class */

