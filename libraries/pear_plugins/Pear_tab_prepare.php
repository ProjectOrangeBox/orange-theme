<?php
/**
 * $records
 * Insert description here
 *
 * @param $key
 * @param $sort_key
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('tab_prepare',function($records,$key,$sort_key) {
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
});
