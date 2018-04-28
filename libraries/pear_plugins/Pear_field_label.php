<?php

class Pear_field_label {

	public function render($model=null,$field=null,$required=null) {
		if (!$field) {
			$rule = [
				'rules'=>'',
				'label'=>$model,
			];
		} else {
			$rule = (class_exists($model,false)) ? ci($model)->rule($field) : [];
		}

		if ($required === null) {
			$required = ((strpos('|'.$rule['rules'].'|','|required|') !== false) ? ' required' : '');
		}

		return '<label class="col-md-3 control-label'.$required.'" for="textinput">'.((empty($rule['label'])) ? ucwords(strtolower($field)) : $rule['label']).'&nbsp;</label>';
	}

}
