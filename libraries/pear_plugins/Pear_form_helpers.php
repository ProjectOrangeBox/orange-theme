<?php

class Pear_form_helpers extends \Pear_plugin
{
	public function __construct()
	{
		if (!config('page.usingWebPackMix')) {
			ci('page')->js('/theme/orange/assets/plugins/form_helpers/form_helpers'.PAGE_MIN.'.js');
		}
	}
}
