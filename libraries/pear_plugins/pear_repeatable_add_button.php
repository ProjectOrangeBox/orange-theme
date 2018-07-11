<?php

class pear_repeatable_add_button extends Pear_plugin {
	public function render($name_as_class=null,$template_id=null) {
		return '<button type="button" data-template="'.$template_id.'" class="'.$name_as_class.' js-repeatable-add btn btn-primary btn-xs">Add</button>';
	}
}
