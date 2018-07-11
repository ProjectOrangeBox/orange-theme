<?php

/* 004_add_nav_menu_settings.php */

class Migration_004_add_nav_menu_settings extends Migration_base {

	/* example up function */
	public function up() {
		$hash = $this->get_hash();

		echo $hash.' up'.chr(10);
		
		
		
		return true;
	}

	/* example down function */
	public function down() {
		$hash = $this->get_hash();

		echo $hash.' down'.chr(10);
		
		return true;
	}

} /* end migration */
