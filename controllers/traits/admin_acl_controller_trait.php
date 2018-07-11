<?php

trait admin_acl_controller_trait {
/**
 * flush_aclAction
 * Insert description here
 *
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
	public function flush_aclAction() {
		delete_cache_by_tags('acl');
	}
}
