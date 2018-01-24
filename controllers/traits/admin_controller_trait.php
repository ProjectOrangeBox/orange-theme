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

trait admin_controller_trait {
	public function indexAction() {
		ci('page')->render(null,['records'=>(($this->controller_model) ? ci($this->controller_model)->index($this->controller_order_by, $this->controller_limit) : [])]);
	}

	public function detailsAction($id = null) {
		($id) ? $this->_edit_record($id) : $this->_new_record();

		ci('page')->render();
	}

	public function indexPostAction() {
		$this->data['primary_key'] = ci($this->controller_model)->insert(ci('input')->request());

		$this->_rest_output();
	}

	public function indexPatchAction() {
		ci($this->controller_model)->update(ci('input')->request());

		$this->_rest_output();
	}

	public function indexDeleteAction() {
		ci($this->controller_model)->delete(hex2bin(ci('input')->request(ci($this->controller_model)->get_primary_key())));

		$this->_rest_output();
	}

	protected function _rest_output() {
		$this->data['ci_errors'] = ci('errors')->as_data();

		ci('output')->json($this->data);
	}

	protected function _new_record() {
		ci('page')->data([
			'record'          => (object)[],
			'ci_title_prefix' => 'New',
			'form_method'     => 'post',
		]);
	}

	protected function _edit_record($id = null) {
		ci('validate')->variable(ci($this->controller_model)->rule(ci($this->controller_model)->get_primary_key(),'rules'), hex2bin($id))->die_on_fail();

		ci('page')->data([
			'record'          => ci($this->controller_model)->get(hex2bin($id)),
			'ci_title_prefix' => 'Edit',
			'form_method'     => 'patch',
		]);
	}

}
