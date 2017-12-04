<?php 

class Plugin_title {

	public function __construct() {
		pear::attach('title',function($title,$icon=null) {
			return '<h3>'.(($icon) ? '<i class="fa fa-'.$icon.'"></i> '.$title : $title).'</h3>';
		});
	}

} /* end class */