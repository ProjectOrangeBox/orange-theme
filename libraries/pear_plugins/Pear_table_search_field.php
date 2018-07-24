<?php

class Pear_table_search_field extends Pear_plugin {

	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/table_search_field/table_search_field'.PAGE_MIN.'.js');
	}

	public function render($length=222,$id='table-search-field') {
		return '<div class="form-group has-feedback" style="display:inline-block"><input type="text" id="'.$id.'" class="form-control input-sm" style="width:'.$length.'px;" placeholder="search"><i class="fa fa-search form-control-feedback"></i></div>';
	}

}
