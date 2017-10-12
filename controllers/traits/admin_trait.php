<?php
/**
 * Orange Framework Extension
 *
 * This content is released under the MIT License (MIT)
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
 */

trait admin_trait {
	/* controller_order_by and controller_limit are options */

	/**
	 * indexAction function.
	 *
	 * Show a List/Grid View
	 *
	 * @access public
	 * @return void
	 */
	public function indexAction() {
		/* model index: $order_by = null, $limit = null, $where = null, $select=null */
		$this->page->render(null,['records'=>(($this->controller_model) ? $this->{$this->controller_model}->index($this->controller_order_by, $this->controller_limit) : [])]);
	}

	/**
	 * detailsAction function.
	 *
	 * Show the New or Edit Details Form
	 *
	 * @author Don Myers
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	public function detailsAction($id = null) {
		((int) $id > 0) ? $this->_edit_record($id) : $this->_new_record();

		$this->page->render();
	}

	/**
	 * indexPostAction function.
	 *
	 * create a new record - REST post
	 *
	 * @author Don Myers
	 * @access public
	 * @return void
	 */
	public function indexPostAction() {
		$this->data['primary_key'] = $this->{$this->controller_model}->insert($this->input->request());

		$this->_rest_output();
	}

	/**
	 * indexPatchAction function.
	 *
	 * update a record - REST patch
	 *
	 * @author Don Myers
	 * @access public
	 * @return void
	 */
	public function indexPatchAction() {
		$this->{$this->controller_model}->update($this->input->request());

		$this->_rest_output();
	}

	/**
	 * indexDeleteAction function.
	 *
	 * delete a record - REST delete
	 *
	 * @author Don Myers
	 * @access public
	 * @return void
	 */
	public function indexDeleteAction() {
		$this->{$this->controller_model}->delete($this->input->request());

		$this->_rest_output();
	}

	/**
	 * _rest_output function.
	 *
	 * REST function output handler
	 *
	 * @author Don Myers
	 * @access protected
	 * @return void
	 */
	protected function _rest_output() {
		$this->data['ci_errors'] = errors::as_data();

		$this->output->json($this->data);
	}

	/**
	 * _new_record protected function.
	 *
	 * Setup Data form New Record Form
	 *
	 * @author Don Myers
	 * @access protected
	 * @return void
	 */
	protected function _new_record() {
		$this->page->data([
			'record'          => (object) [$this->_primary_id => -1],
			'ci_title_prefix' => 'New',
			'form_method'     => 'post',
		]);
	}

	/**
	 * _edit_record protected function.
	 *
	 * Setup Data form Edit Record Form
	 *
	 * @author Don Myers
	 * @access protected
	 * @param mixed $id (default: null)
	 * @return void
	 */
	protected function _edit_record($id = null) {
		/* let's make sure the $id is in the correct format */
		$this->validate->variable($this->{$this->controller_model}->rule($this->{$this->controller_model}->get_primary_key(), 'rules'), $id)->die_on_fail();

		$this->page->data([
			'record'          => $this->{$this->controller_model}->get($id),
			'ci_title_prefix' => 'Edit',
			'form_method'     => 'patch',
		]);
	}

} /* end class */