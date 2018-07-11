<?php

/* 001_init.php */

class Migration_001_init extends Migration_base {

	/* example up function */
	public function up() {
		/* default users */
		#ci()->db->query("INSERT INTO `orange_users` (`id`, `created_on`, `created_by`, `created_ip`, `updated_on`, `updated_by`, `updated_ip`, `deleted_on`, `deleted_by`, `deleted_ip`, `is_deleted`, `username`, `email`, `password`, `dashboard_url`, `user_read_role_id`, `user_edit_role_id`, `user_delete_role_id`, `read_role_id`, `edit_role_id`, `delete_role_id`, `is_active`, `last_login`, `last_ip`) VALUES (1,NULL,1,NULL,'2017-12-01 10:45:22',10,'192.168.64.1',NULL,0,NULL,0,'Administrator','admin@quadratec.com','false',NULL,1,1,1,1,1,0,1,NULL,'0.0.0.0')");
		#ci()->db->query("INSERT INTO `orange_users` (`id`, `created_on`, `created_by`, `created_ip`, `updated_on`, `updated_by`, `updated_ip`, `deleted_on`, `deleted_by`, `deleted_ip`, `is_deleted`, `username`, `email`, `password`, `dashboard_url`, `user_read_role_id`, `user_edit_role_id`, `user_delete_role_id`, `read_role_id`, `edit_role_id`, `delete_role_id`, `is_active`, `last_login`, `last_ip`) VALUES (2,NULL,1,NULL,'2017-11-28 12:31:56',1,'192.168.64.1','2018-01-08 09:07:24',10,'172.16.65.35',0,'Known User','guest@example.com','false',NULL,2,2,2,1,1,0,1,NULL,'0.0.0.0')");
		#ci()->db->query("INSERT INTO `orange_users` (`id`, `created_on`, `created_by`, `created_ip`, `updated_on`, `updated_by`, `updated_ip`, `deleted_on`, `deleted_by`, `deleted_ip`, `is_deleted`, `username`, `email`, `password`, `dashboard_url`, `user_read_role_id`, `user_edit_role_id`, `user_delete_role_id`, `read_role_id`, `edit_role_id`, `delete_role_id`, `is_active`, `last_login`, `last_ip`) VALUES (3,NULL,1,NULL,'2017-11-28 12:31:49',1,'192.168.64.1','2018-01-08 09:07:31',0,'',0,'Unknown User','nobody@example.com','false',NULL,3,3,3,1,1,0,1,NULL,'0.0.0.0')");

		/* default roles */
		#ci()->db->query("INSERT INTO `orange_roles` (`id`, `name`, `description`, `migration`) VALUES (1,'Admin','Logged in super user','Migration_001_init')");
		#ci()->db->query("INSERT INTO `orange_roles` (`id`, `name`, `description`, `migration`) VALUES (2,'User','Logged in user but not a administrator','Migration_001_init')");
		#ci()->db->query("INSERT INTO `orange_roles` (`id`, `name`, `description`, `migration`) VALUES (3,'Nobody','User not logged in','Migration_001_init')");

		return true;
	}

	/* example down function */
	public function down() {
		/* don't delete the defaults */

		return true;
	}

} /* end migration */