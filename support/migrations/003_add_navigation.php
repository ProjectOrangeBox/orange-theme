<?php

/* 003_add_navigation.php */

class Migration_003_add_navigation extends Migration_base {

	public function up() {
		ci('o_nav_model')->migration_add('/left-menu','Left Menu',__CLASS__);
		ci('o_nav_model')->migration_add('/right-menu','Right Menu',__CLASS__);
		ci('o_nav_model')->migration_add('/extra-menu','Extra Menu',__CLASS__);

		ci('o_nav_model')->migration_add('/admin-main-menu','Admin',__CLASS__);

		/* Users */
		ci('o_nav_model')->migration_add('/users','Users',__CLASS__);
		
		/* Admin Dashboard */
		ci('o_nav_model')->migration_add('/admin/dashboard','Dashboard',__CLASS__);
		
		/* Admin Nav */
		ci('o_nav_model')->migration_add('/admin/nav','Nav',__CLASS__);
		
		/* Admin Permissions */
		ci('o_nav_model')->migration_add('/admin/permissions','Permissions',__CLASS__);
		
		/* Admin Roles */
		ci('o_nav_model')->migration_add('/admin/roles','Roles',__CLASS__);
		
		/* Admin Settings */
		ci('o_nav_model')->migration_add('/admin/settings','Settings',__CLASS__);
		
		/* Admin Users */
		ci('o_nav_model')->migration_add('/admin/users','Users',__CLASS__);
		
		return true;
	}

	/* example down function */
	public function down() {
		ci('o_nav_model')->migration_remove(__CLASS__);
		
		return true;
	}

} /* end migration */
