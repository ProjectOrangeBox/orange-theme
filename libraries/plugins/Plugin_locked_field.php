<?php
class Plugin_locked_field {

	/*
	$extra
		method = [new/edit/...]
		can = user can permission
	
	*/
	public function __construct() {
		html::attach('locked_field',function($name=null,$value=null,$extra=[]) {
			ci()->page->js('/theme/orange/assets/plugins/plugin-locked-field/plugin_locked_field.js');
	
			$extra = array_merge(['default'=>'lock','can'=>'####','class'=>''],$extra);
			
			/* default to locked */
			$show_lock = true;
			
			/* is this a new record page form? */
			if ($extra['method'] == 'post') {
				$extra['default'] = '';
				$show_lock = false;
			}

			$html = '<input type="text" '.(($extra['default'] == 'lock') ? 'readonly' : '').' id="'.$name.'" name="'.$name.'" value="'.$value.'" class="'.$extra['class'].'" style="width:100%; display:inline">';
			
			/* do we need to show the lock? */
			if ($show_lock) {
				if (user::can($extra['can'])) {
					$html .= '<a style="margin-left: -24px" class="js-locked-field-lock" href="#" data-lock="true"><i class="fa fa-'.(($show_lock) ? 'lock' : 'unlock').'"></i></a>';
				}
			}
			
			return $html;
		});
	}

} /* end class */






