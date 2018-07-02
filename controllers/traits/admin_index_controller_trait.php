<?php

trait admin_index_controller_trait {
/**
 * Call the controllers default model index method with controllers order by and limit
 *
 */
	public function indexAction() {
		ci('page')->render(null,['records'=>(($this->controller_model) ? ci($this->controller_model)->index($this->controller_order_by, $this->controller_limit) : [])]);
	}

}
