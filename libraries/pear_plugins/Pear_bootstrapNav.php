<?php

class Pear_bootstrapNav extends \Pear_plugin
{
	public function render($parent_id=null, $config=null, $filter=true)
	{
		return ci('nav_library')->build_bootstrap_nav($parent_id,$config,$filter);
	}
}
