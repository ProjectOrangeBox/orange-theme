<?php

class Pear_confirm_dialog extends \Pear_plugin
{
	public function __construct()
	{
		ci('page')->js('/theme/orange/assets/plugins/confirm-dialog/config-dialog'.PAGE_MIN.'.js');
	}
}
