<?php

/* 002_add_permission.php */

class Migration_002_add_permission extends Migration_base {

	/* example up function */
	public function up() {
		/* Admin Permissions */
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~get','Admin Permissions','Admin Permissions Index Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/permissions::details~get','Admin Permissions','Admin Permissions Details Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~post','Admin Permissions','Admin Permissions Index Post',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~patch','Admin Permissions','Admin Permissions Index Patch',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~delete','Admin Permissions','Admin Permissions Index Delete',__CLASS__);
		
		/* Admin Roles */
		ci('o_permission_model')->migration_add('url::/admin/roles::details~get','Admin Roles','Admin Roles Details Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~post','Admin Roles','Admin Roles Index Post',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~patch','Admin Roles','Admin Roles Index Patch',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~delete','Admin Roles','Admin Roles Index Delete',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~get','Admin Roles','Admin Roles Index Get',__CLASS__);
		
		/* Admin Settings */
		ci('o_permission_model')->migration_add('url::/admin/settings::editor~get','Admin Settings','Admin Settings Editor Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~get','Admin Settings','Admin Settings Index Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/settings::details~get','Admin Settings','Admin Settings Details Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~post','Admin Settings','Admin Settings Index Post',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~patch','Admin Settings','Admin Settings Index Patch',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~delete','Admin Settings','Admin Settings Index Delete',__CLASS__);
		
		/* Admin Users */
		ci('o_permission_model')->migration_add('url::/admin/users::index~post','Admin Users','Admin Users Index Post',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/users::index~patch','Admin Users','Admin Users Index Patch',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/users::index~delete','Admin Users','Admin Users Index Delete',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/users::index~get','Admin Users','Admin Users Index Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/users::details~get','Admin Users','Admin Users Details Get',__CLASS__);

		/* Admin Nav */
		ci('o_permission_model')->migration_add('url::/admin/nav::sort~get','Admin Nav','Admin Nav Sort Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/nav::sort~post','Admin Nav','Admin Nav Sort Post',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~get','Admin Nav','Admin Nav Index Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/nav::details~get','Admin Nav','Admin Nav Details Get',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~post','Admin Nav','Admin Nav Index Post',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~patch','Admin Nav','Admin Nav Index Patch',__CLASS__);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~delete','Admin Nav','Admin Nav Index Delete',__CLASS__);

		return true;
	}

	/* example down function */
	public function down() {
		ci('o_permission_model')->migration_remove(__CLASS__);

		return true;
	}

} /* end migration */