<?php 

class Plugin_header_button {

	public function __construct() {
		plugin::attach('header_button',function($uri='',$title='',$attributes=[]) {
			$default_attributes = ['class'=>'btn btn-default btn-sm'];
	
			$attributes = array_merge($default_attributes,(array)$attributes);
	
			return anchor($uri,'<i class="fa fa-'.$attributes['icon'].'" aria-hidden="true"></i> '.$title,$attributes);
		});
	}

} /* end class */