<?php

class Pear_tab_prepare extends \Pear_plugin
{
	public function render($records=null, $key=null, $sort_key=null)
	{
		$tabs = [];

		foreach ($records as $row) {
			$tabs[$row->$key][$row->$sort_key] = $row;
		}

		ksort($tabs);

		foreach ($tabs as $idx=>$ary) {
			ksort($ary);
			$tabs[$idx] = $ary;
		}

		return $tabs;
	}
}
