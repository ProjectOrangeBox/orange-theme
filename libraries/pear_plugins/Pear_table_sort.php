<?php

class Pear_table_sort extends \Pear_plugin
{
	public function __construct()
	{
		ci('page')
			->js([
				'/theme/orange/assets/plugins/table_sort/table_sort'.PAGE_MIN.'.js',
				'//cdnjs.cloudflare.com/ajax/libs/tinysort/3.1.4/tinysort.js',
			])
			->css('/theme/orange/assets/plugins/table_sort/table_sort'.PAGE_MIN.'.css');
	}
}
