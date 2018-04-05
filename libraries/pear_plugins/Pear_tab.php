<?php

/* provides saving the last selected tab for a give html page */
ci('page')->js('/theme/orange/assets/plugins/orange-tab-save/orange-tab-save.min.js');

pear::attach('tab_id',function($value) {
	return md5($value);
});

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

pear::attach('tab_title',function($string) {
	return htmlspecialchars(ucwords($string), ENT_QUOTES, 'UTF-8');
});
