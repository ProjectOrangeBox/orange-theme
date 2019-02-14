<?php

class Pear_input_mask extends Pear_plugin
{
	public function __construct()
	{
		ci('page')->js('/theme/orange/assets/plugins/input_mask/input-mask.min.js');
	}
}
