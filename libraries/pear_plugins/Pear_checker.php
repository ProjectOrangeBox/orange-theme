<?php

class Pear_checker extends Pear_plugin {

	public function render($name=null,$value=null,$checked=false,$extra=[]) {
		$unchecked = ($extra['unchecked']) ? $extra['unchecked'] : 0;

		unset($extra['unchecked']);

		if (!is_bool($checked)) {
			$checked = ($value == $checked);
		}

		return '<input type="hidden" name="'.$name.'" value="'.$unchecked.'"><input type="checkbox" name="'.$name.'" value="'.$value.'" '.$this->_convert2attributes($extra).' '.(($checked) ? 'checked' : '').'>';
	}

}
