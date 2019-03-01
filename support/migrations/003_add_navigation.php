<?php

/* 003_add_navigation.php */

class Migration_003_add_navigation extends Migration_base
{
	public function up()
	{
		$hash = $this->get_hash();

		echo $hash.' up'.chr(10);

		/* root menu */
		ci()->db->query("INSERT INTO `orange_nav` (`id`, `created_on`, `created_by`, `created_ip`, `updated_on`, `updated_by`, `updated_ip`, `access`, `url`, `text`, `parent_id`, `sort`, `target`, `class`, `active`, `color`, `icon`, `read_role_id`, `edit_role_id`, `delete_role_id`, `migration`) VALUES (1,'2018-07-12 11:36:06',3,'0.0.0.0','2018-07-12 11:40:00',1,'192.168.64.1',0,'/root-menu','Root Menu',0,0,'','',1,'000000','thumbs-up',1,1,1,'packages/projectorangebox/theme-orange/003_add_navigation')");


		ci('o_nav_model')->migration_add('/left-menu', 'Left Menu', $hash, ['icon'=>'window-close','color'=>'E16F14']);
		ci('o_nav_model')->migration_add('/right-menu', 'Right Menu', $hash, ['icon'=>'window-close','color'=>'E16F14']);
		ci('o_nav_model')->migration_add('/extra-menu', 'Extra Menu', $hash, ['icon'=>'window-close','color'=>'E16F14']);

		ci('o_nav_model')->migration_add('/admin-main-menu', 'Admin', $hash, ['icon'=>'window-close','color'=>'E16F14']);

		/* Admin Dashboard */
		ci('o_nav_model')->migration_add('/admin/dashboard', 'Dashboard', $hash, ['icon'=>'rebel','color'=>'E36B2A']);
		
		/* Admin Nav */
		ci('o_nav_model')->migration_add('/admin/nav', 'Nav', $hash, ['icon'=>'rebel','color'=>'E36B2A']);
		
		/* Admin Permissions */
		ci('o_nav_model')->migration_add('/admin/permissions', 'Permissions', $hash, ['icon'=>'rebel','color'=>'E36B2A']);
		
		/* Admin Roles */
		ci('o_nav_model')->migration_add('/admin/roles', 'Roles', $hash, ['icon'=>'rebel','color'=>'E36B2A']);
		
		/* Admin Settings */
		ci('o_nav_model')->migration_add('/admin/settings', 'Settings', $hash, ['icon'=>'rebel','color'=>'E36B2A']);
		
		/* Admin Users */
		ci('o_nav_model')->migration_add('/admin/users', 'Users', $hash, ['icon'=>'rebel','color'=>'E36B2A']);
		
		return true;
	}

	/* example down function */
	public function down()
	{
		echo $hash.' down'.chr(10);

		ci('o_nav_model')->migration_remove($hash);
		
		return true;
	}
} /* end migration */
