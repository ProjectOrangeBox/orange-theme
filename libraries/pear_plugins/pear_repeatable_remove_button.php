<?php

class pear_repeatable_remove_button extends Pear_plugin {
	public function render($name_as_class=null,$template_id=null) {
		return '<button type="button" data-template="'.$template_id.'" class="'.$name_as_class.' js-repeatable-remove btn btn-danger btn-xs">Remove</button>';
	}
}
