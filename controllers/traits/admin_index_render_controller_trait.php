<?php

trait admin_index_render_controller_trait {
	public function indexAction() {
		ci('page')->render();
	}
}
