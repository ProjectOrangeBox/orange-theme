<?php

class Pear_field_input {

	public function render($model=null,$field=null) {
		if (!$field) {
			$rule = [
				'rules'=>'',
				'label'=>$model,
			];
		} else {
			$rule = (class_exists($model,false)) ? ci($model)->rule($field) : [];
		}

		return '<label class="col-md-3 control-label'.((strpos('|'.$rule['rules'].'|','|required|') !== false) ? ' required' : '').'" for="textinput">'.((empty($rule['label'])) ? ucwords(strtolower($field)) : $rule['label']).'&nbsp;</label>';
	}

}
