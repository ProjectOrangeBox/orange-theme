<?php

/* 002_add_permission.php */

class Migration_002_add_permission extends Migration_base
{

	/* example up function */
	public function up()
	{
		$hash = $this->get_hash();

		echo $hash.' up'.chr(10);

		/* Admin Settings */
		ci('o_permission_model')->migration_add('url::/admin/settings::editor~get', 'Admin Settings', 'Admin Settings Editor Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~get', 'Admin Settings', 'Admin Settings Index Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/settings::details~get', 'Admin Settings', 'Admin Settings Details Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~post', 'Admin Settings', 'Admin Settings Index Post', $hash);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~patch', 'Admin Settings', 'Admin Settings Index Patch', $hash);
		ci('o_permission_model')->migration_add('url::/admin/settings::index~delete', 'Admin Settings', 'Admin Settings Index Delete', $hash);

		/* Admin Users */
		ci('o_permission_model')->migration_add('url::/admin/users::index~post', 'Admin Users', 'Admin Users Index Post', $hash);
		ci('o_permission_model')->migration_add('url::/admin/users::index~patch', 'Admin Users', 'Admin Users Index Patch', $hash);
		ci('o_permission_model')->migration_add('url::/admin/users::index~delete', 'Admin Users', 'Admin Users Index Delete', $hash);
		ci('o_permission_model')->migration_add('url::/admin/users::index~get', 'Admin Users', 'Admin Users Index Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/users::details~get', 'Admin Users', 'Admin Users Details Get', $hash);

		/* Admin Roles */
		ci('o_permission_model')->migration_add('url::/admin/roles::details~get', 'Admin Roles', 'Admin Roles Details Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~post', 'Admin Roles', 'Admin Roles Index Post', $hash);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~patch', 'Admin Roles', 'Admin Roles Index Patch', $hash);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~delete', 'Admin Roles', 'Admin Roles Index Delete', $hash);
		ci('o_permission_model')->migration_add('url::/admin/roles::index~get', 'Admin Roles', 'Admin Roles Index Get', $hash);

		/* Admin Permissions */
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~get', 'Admin Permissions', 'Admin Permissions Index Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/permissions::details~get', 'Admin Permissions', 'Admin Permissions Details Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~post', 'Admin Permissions', 'Admin Permissions Index Post', $hash);
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~patch', 'Admin Permissions', 'Admin Permissions Index Patch', $hash);
		ci('o_permission_model')->migration_add('url::/admin/permissions::index~delete', 'Admin Permissions', 'Admin Permissions Index Delete', $hash);
		
		/* Admin Nav */
		ci('o_permission_model')->migration_add('url::/admin/nav::sort~get', 'Admin Nav', 'Admin Nav Sort Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/nav::sort~post', 'Admin Nav', 'Admin Nav Sort Post', $hash);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~get', 'Admin Nav', 'Admin Nav Index Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/nav::details~get', 'Admin Nav', 'Admin Nav Details Get', $hash);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~post', 'Admin Nav', 'Admin Nav Index Post', $hash);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~patch', 'Admin Nav', 'Admin Nav Index Patch', $hash);
		ci('o_permission_model')->migration_add('url::/admin/nav::index~delete', 'Admin Nav', 'Admin Nav Index Delete', $hash);

		return true;
	}

	/* example down function */
	public function down()
	{
		$hash = $this->get_hash();

		echo $hash.' down'.chr(10);

		ci('o_permission_model')->migration_remove($hash);

		return true;
	}
} /* end migration */
