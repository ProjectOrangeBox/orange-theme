<?php

class Pear_textarea extends Pear_plugin {

	public function render($name=null,$value=null,$options=null) {
		if (is_array($name)) {
			$value = $options['value'];					
			$options = $name;
			$name = $options['name'];

			unset($options['value']);
		}


		$defaults = [
			'name'=>$name,
			'cols'=>'40',
			'rows'=>'10',
			'class'=>'',
			'id'=>$name,
		];

		$attributes = array_diff_key($defaults,(array)$options) + array_intersect_key((array)$options, $defaults);

		return '<textarea '.$this->_convert2attributes($attributes).'>'	.e($value)	."</textarea>\n";
	}
}
