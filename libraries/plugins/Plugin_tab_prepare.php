<?php 

class Plugin_tab_prepare {

	public function __construct() {
		plugin::attach('tab_prepare',function($tabs,$records,$key,$sort_key) {
			/* build the tabs */
			foreach ($records as $row) {
				$tabs[$row->$key][$row->$sort_key] = $row;
			}
		
			/* now sort each tabs records by the sort key */
			foreach ($tabs as $idx=>$ary) {
				ksort($ary);
		
				$tabs[$idx] = $ary;
			}
			
			return $tabs;
		});
	}

} /* end class */