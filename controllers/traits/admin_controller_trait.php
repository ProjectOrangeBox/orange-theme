<?php
trait admin_controller_trait {
/**
 * indexAction
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
	public function indexAction() {
		ci('page')->render(null,['records'=>(($this->controller_model) ? ci($this->controller_model)->index($this->controller_order_by, $this->controller_limit) : [])]);
	}

/**
 * detailsAction
 * Insert description here
 *
 * @param $id
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
	public function detailsAction($id = null) {
		($id) ? $this->_edit_record($id) : $this->_new_record();
		ci('page')->render();
	}

/**
 * indexPostAction
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
	public function indexPostAction() {
		$this->data['primary_key'] = ci($this->controller_model)->insert(ci('input')->request());
		$this->_rest_output();
	}

/**
 * indexPatchAction
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
	public function indexPatchAction() {
		ci($this->controller_model)->update(ci('input')->request());
		$this->_rest_output();
	}

/**
 * indexDeleteAction
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
	public function indexDeleteAction() {
		ci($this->controller_model)->delete(hex2bin(ci('input')->request(ci($this->controller_model)->get_primary_key())));
		$this->_rest_output();
	}

/**
 * _rest_output
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
	protected function _rest_output() {
		$this->data['ci_errors'] = ci('errors')->as_data();
		ci('output')->json($this->data);
	}

/**
 * _new_record
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
	protected function _new_record() {
		ci('page')->data([
			'record'          => (object)[],
			'ci_title_prefix' => 'New',
			'form_method'     => 'post',
		]);
	}

/**
 * _edit_record
 * Insert description here
 *
 * @param $id
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
	protected function _edit_record($id = null) {
		ci('validate')->variable(ci($this->controller_model)->rule(ci($this->controller_model)->get_primary_key(),'rules'), hex2bin($id))->die_on_fail();
		ci('page')->data([
			'record'          => ci($this->controller_model)->get(hex2bin($id)),
			'ci_title_prefix' => 'Edit',
			'form_method'     => 'patch',
		]);
	}
}
