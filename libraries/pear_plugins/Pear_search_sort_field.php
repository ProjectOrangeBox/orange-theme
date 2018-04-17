<?php

class Pear_search_sort_field extends Pear_plugin {

	public function __construct() {
		ci('page')
			->js([
				'//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js',
				'/theme/orange/assets/plugins/search-sort/bootstrap-sortable.min.js',
				'/theme/orange/assets/plugins/search-sort/o-search-sort'.PAGE_MIN.'.js',
			])
			->css('/theme/orange/assets/plugins/search-sort/bootstrap-sortable.min.css',75);
	}

	public function render($length=222,$id='search_sort_filter') {
		return '<div class="form-group has-feedback" style="display:inline-block"><input type="text" id="'.$id.'" class="form-control input-sm" style="width:'.$length.'px;" placeholder="search"><i class="fa fa-search form-control-feedback"></i></div>';
	}

}
