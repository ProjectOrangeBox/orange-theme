<?php

class Plugin_fa_enum_icon {

	public function __construct() {
		html::attach('fa_enum_icon',function($value=-1,$string = 'circle-o|check-circle-o',$extra='fa-lg',$delimiter = '|') {
			$enum = explode($delimiter,$string);
			
			return '<i class="fa fa-'.$enum[(int)$value].' '.$extra.'"></i>';
		});
	}

} /* end class */