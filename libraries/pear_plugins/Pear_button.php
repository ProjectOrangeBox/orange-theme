<?php

pear::attach('button_new',function($uri='',$title='New',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm js-new'];
	$attributes = array_merge($default_attributes,(array)$attributes);
	return anchor($uri,'<i class="fa fa-magic" aria-hidden="true"></i> '.$title,$attributes);
});

pear::attach('button_delete',function($uri='',$attributes=[]) {
	$name = ($attributes['primary_key']) ? $attributes['primary_key'] : 'id';
	$html  = '<form action="'.$uri.'" method="delete" data-confirm="true" data-fadeout="tr">';
	$html .= '<input type="hidden" name="'.$name.'" value="'.bin2hex($attributes[$name]).'">';
	$html .= '<a href="#" class="js-button-submit">';
	$html .= '<i class="fa fa-trash fa-lg" aria-hidden="true">';
	$html .= '</i>';
	$html .= '</a>';
	$html .= '</form>';
	return $html;
});

pear::attach('button_edit',function($uri='',$attributes=[]) {
	return anchor($uri,'<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>',$attributes);
});

pear::attach('button_goback',function($uri='',$title='Go Back',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm js-esc'];
	$attributes = array_merge($default_attributes,(array)$attributes);
	return anchor($uri,'<i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i> '.$title,$attributes);
});

pear::attach('button_header',function($uri='',$title='',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm'];
	$attributes = array_merge($default_attributes,(array)$attributes);
	return anchor($uri,'<i class="fa fa-'.$attributes['icon'].'" aria-hidden="true"></i> '.$title,$attributes);
});

pear::attach('button_new',function($uri='',$title='New',$attributes=[]) {
	$default_attributes = ['class'=>'btn btn-default btn-sm js-new'];
	$attributes = array_merge($default_attributes,(array)$attributes);
	return anchor($uri,'<i class="fa fa-magic" aria-hidden="true"></i> '.$title,$attributes);
});
