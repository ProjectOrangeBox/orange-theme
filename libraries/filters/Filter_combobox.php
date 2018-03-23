<?php

class Filter_combobox extends Filter_base {
	public function filter(&$field, $options) {
		$field = $this->field_data[$options];
	}
}
