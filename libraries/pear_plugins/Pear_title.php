<?php

class Pear_title extends Pear_plugin
{
	public function render($title='', $icon=null, $help='')
	{
		return '<h3>'.(($icon) ? '<i class="fa fa-'.$icon.'"></i> '.$title : $title).' <small>'.$help.'</small></h3>';
	}
}
