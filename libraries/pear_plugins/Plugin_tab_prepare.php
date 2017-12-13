<?php 

class Plugin_tab_prepare {

	public function __construct() {
		pear::attach('tab_prepare',function($tabs,$records,$key,$sort_key) {

			/* build the tabs */
			foreach ($records as $row) {
				$tabs[$row->$key][$row->$sort_key] = $row;
			}
			
			/* sort the tab names */
			ksort($tabs);
		
			/* now sort each tabs records by the sort key */
			foreach ($tabs as $idx=>$ary) {
				/* sort the tab content */
				ksort($ary);
		
				$tabs[$idx] = $ary;
			}
			
			return $tabs;
		});
	}

} /* end class */