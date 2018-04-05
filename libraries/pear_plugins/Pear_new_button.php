<?php

/* deprecated please use button_new */
pear::attach('new_button',function($uri='',$title='New',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm js-new'];
	$attributes = array_merge($default_attributes,(array)$attributes);
	return anchor($uri,'<i class="fa fa-magic" aria-hidden="true"></i> '.$title,$attributes);
});
