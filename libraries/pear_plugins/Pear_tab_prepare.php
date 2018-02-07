<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
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
