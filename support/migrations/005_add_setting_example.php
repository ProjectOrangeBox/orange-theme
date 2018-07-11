<?php

/* Migration_005_scaffolding_add_setting_example.php */

class Migration_005_add_setting_example extends Migration_base {

	/* example up function */
	public function up() {
		$hash = $this->get_hash();

		echo $hash.' up'.chr(10);

		ci('o_setting_model')->migration_add('Left','nav',0,'','{"type":"text","width":"8","mask":"int"}',$hash);
		ci('o_setting_model')->migration_add('Right','nav',0,'','{"type":"text","width":"8","mask":"int"}',$hash);
		
		return true;
	}

	/* example down function */
	public function down() {
		$hash = $this->get_hash();

		echo $hash.' down'.chr(10);

		ci('o_setting_model')->migration_remove($hash);
		
		return true;
	}

} /* end migration */
