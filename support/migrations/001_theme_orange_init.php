<?php

/* 002_Scaffolding_init */

class Migration_theme_orange_init extends Migration_base {

	/* example up function */
	public function up() {
		/* Theme Orange */
		ci('o_permission_model')->add('url::/login::index~get','Theme Orange','Get Login Index');
		ci('o_permission_model')->add('url::/login::index~post','Theme Orange','Post Login Index');
		ci('o_permission_model')->add('url::/login::inverted~get','Theme Orange','Get Login Inverted');
		
		ci('o_permission_model')->add('url::/users::edit_profile~get','Theme Orange','Get Users Edit Profile');
		ci('o_permission_model')->add('url::/admin/users::index~patch','Theme Orange','Admin Patch Users Index');
		ci('o_permission_model')->add('url::/admin/users::index~get','Theme Orange','Admin Get Users Index');
		ci('o_permission_model')->add('url::/admin/users::details~get','Theme Orange','Admin Get Users Details');
		ci('o_permission_model')->add('url::/admin/users::index~post','Theme Orange','Admin Post Users Index');
		ci('o_permission_model')->add('url::/admin/users::index~delete','Theme Orange','Admin Delete Users Index');
		
		ci('o_permission_model')->add('url::/admin/dashboard::index~get','Theme Orange','Admin Get Dashboard Index');
		ci('o_permission_model')->add('url::/admin/dashboard::details~get','Theme Orange','Admin Get Dashboard Details');
		ci('o_permission_model')->add('url::/admin/dashboard::index~post','Theme Orange','Admin Post Dashboard Index');
		ci('o_permission_model')->add('url::/admin/dashboard::index~patch','Theme Orange','Admin Patch Dashboard Index');
		ci('o_permission_model')->add('url::/admin/dashboard::index~delete','Theme Orange','Admin Delete Dashboard Index');
		
		ci('o_permission_model')->add('url::/admin/nav::index~get','Theme Orange','Admin Get Nav Index');
		ci('o_permission_model')->add('url::/admin/nav::details~get','Theme Orange','Admin Get Nav Details');
		ci('o_permission_model')->add('url::/admin/nav::index~post','Theme Orange','Admin Post Nav Index');
		ci('o_permission_model')->add('url::/admin/nav::index~patch','Theme Orange','Admin Patch Nav Index');
		ci('o_permission_model')->add('url::/admin/nav::index~delete','Theme Orange','Admin Delete Nav Index');
		
		ci('o_permission_model')->add('url::/admin/permissions::index~get','Theme Orange','Admin Get Permissions Index');
		ci('o_permission_model')->add('url::/admin/permissions::details~get','Theme Orange','Admin Get Permissions Details');
		ci('o_permission_model')->add('url::/admin/permissions::index~post','Theme Orange','Admin Post Permissions Index');
		ci('o_permission_model')->add('url::/admin/permissions::index~patch','Theme Orange','Admin Patch Permissions Index');
		ci('o_permission_model')->add('url::/admin/permissions::index~delete','Theme Orange','Admin Delete Permissions Index');
		
		ci('o_permission_model')->add('url::/admin/roles::details~get','Theme Orange','Admin Get Roles Details');
		ci('o_permission_model')->add('url::/admin/roles::index~post','Theme Orange','Admin Post Roles Index');
		ci('o_permission_model')->add('url::/admin/roles::index~patch','Theme Orange','Admin Patch Roles Index');
		ci('o_permission_model')->add('url::/admin/roles::index~delete','Theme Orange','Admin Delete Roles Index');
		ci('o_permission_model')->add('url::/admin/roles::index~get','Theme Orange','Admin Get Roles Index');
		
		ci('o_permission_model')->add('url::/admin/settings::editor~get','Theme Orange','Admin Get Settings Editor');
		ci('o_permission_model')->add('url::/admin/settings::index~get','Theme Orange','Admin Get Settings Index');
		ci('o_permission_model')->add('url::/admin/settings::details~get','Theme Orange','Admin Get Settings Details');
		ci('o_permission_model')->add('url::/admin/settings::index~post','Theme Orange','Admin Post Settings Index');
		ci('o_permission_model')->add('url::/admin/settings::index~patch','Theme Orange','Admin Patch Settings Index');
		ci('o_permission_model')->add('url::/admin/settings::index~delete','Theme Orange','Admin Delete Settings Index');
		return true;
	}

	/* example down function */
	public function down() {
		ci('o_permission_model')->delete_by(['group'=>'Theme Orange']);
		
		return true;
	}

} /* end migration */