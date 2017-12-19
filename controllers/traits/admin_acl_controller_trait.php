<?php 

trait admin_acl_controller_trait {

	public function flush_aclAction() {
		delete_cache_by_tags('acl');
	}

} /* end class */
