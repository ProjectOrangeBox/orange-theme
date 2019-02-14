<?php

/* 004_add_nav_menu_settings.php */

class Migration_004_add_nav_menu_settings extends Migration_base
{

	/* example up function */
	public function up()
	{
		$hash = $this->get_hash();

		echo $hash.' up'.chr(10);
		
		ci('o_setting_model')->migration_add('Left', 'nav', 2, '', '{"type":"text","width":"8","mask":"int"}', $hash);
		ci('o_setting_model')->migration_add('Right', 'nav', 3, '', '{"type":"text","width":"8","mask":"int"}', $hash);

		return true;
	}

	/* example down function */
	public function down()
	{
		$hash = $this->get_hash();

		echo $hash.' down'.chr(10);

		ci('o_setting_model')->migration_remove($hash);
		
		return true;
	}
} /* end migration */
