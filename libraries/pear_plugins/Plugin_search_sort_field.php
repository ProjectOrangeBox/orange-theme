<?php

class Plugin_search_sort_field {

	public function __construct() {
		pear::attach('search_sort_field',function($length=222) {
			ci()->page
				->js([
					'//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js',
					'//cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js', /* add debounce to filter input */
					'/theme/orange/assets/plugins/search-sort/bootstrap-sortable.min.js',
					'/theme/orange/assets/plugins/search-sort/o-search-sort.min.js',
				])
				->css('/theme/orange/assets/plugins/search-sort/bootstrap-sortable.min.css',75);

			return '<div class="form-group has-feedback" style="display:inline-block"><input type="text" id="search_sort_filter" class="form-control input-sm" style="width:'.$length.'px;" placeholder="search"><i class="fa fa-search form-control-feedback"></i></div>';
		});
	}

} /* end class */