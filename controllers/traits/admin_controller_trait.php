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
		ci('page')->render(null,['records'=>(($this->controller_model) ? $this->{$this->controller_model}->index($this->controller_order_by, $this->controller_limit) : [])]);
	}

	public function detailsAction($id = null) {
		($id) ? $this->_edit_record(hex2bin($id)) : $this->_new_record();

		ci('page')->render();
	}

	public function indexPostAction() {
		$this->data['primary_key'] = $this->{$this->controller_model}->insert(ci('input')->request());

		$this->_rest_output();
	}

	public function indexPatchAction() {
		$this->{$this->controller_model}->update(ci('input')->request());

		$this->_rest_output();
	}

	public function indexDeleteAction() {
		$this->{$this->controller_model}->delete(ci('input')->request());

		$this->_rest_output();
	}

	protected function _rest_output() {
		$this->data['ci_errors'] = errors::as_data();

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
		$primary_key = $this->{$this->controller_model}->get_primary_key();
		$primary_rules = $this->{$this->controller_model}->rule($primary_key,'rules');

		ci('validate')->variable($primary_rules, $id)->die_on_fail();

		ci('page')->data([
			'record'          => $this->{$this->controller_model}->get($id),
			'ci_title_prefix' => 'Edit',
			'form_method'     => 'patch',
		]);
	}
}
