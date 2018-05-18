<?php

class Pear_checker extends Pear_plugin {

	public function render($name=null,$value=null,$checked=false,$extra=[]) {
		$on = ($extra['on']) ? $extra['on'] : 1;
		$off = ($extra['off']) ? $extra['off'] : 0;
		
		unset($extra['on'],$extra['off']);

		return '<input type="checkbox" '.$this->_convert2attributes($extra).' onchange="$(this).next().val(($(this).is(\':checked\'))?\''.$on.'\':\''.$off.'\')" '.(($checked) ? 'checked' : '').'><input type="hidden" name="'.$name.'" value="'.(($checked) ? $on : $off).'">';
	}

}