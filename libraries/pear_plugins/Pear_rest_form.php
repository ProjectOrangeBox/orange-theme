<?php

class Pear_rest_form extends \Pear_plugin
{
	public function __construct()
	{
		if (!config('page.usingWebPackMix')) {
			ci('page')->js('/theme/orange/assets/plugins/rest-form/rest-form'.PAGE_MIN.'.js');
		}
	}
}
