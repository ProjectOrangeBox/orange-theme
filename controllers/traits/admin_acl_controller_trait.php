<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
 */

trait admin_acl_controller_trait {
	public function flush_aclAction() {
		delete_cache_by_tags('acl');
	}
}
