<?php

trait admin_controller_trait {
/**
 * Call the controllers default model index method with controllers order by and limit
 *
 */
	public function indexAction() {
		$records = [];
	
		if (isset($this->controller_model)) {
			$limit = (isset($this->controller_limit)) ? $this->controller_limit : null;
			$order_by = (isset($this->controller_order_by)) ? $this->controller_order_by : null;

			$records =ci($this->controller_model)->index($order_by,$limit);
		}
	
	
		ci('page')->render(null,['records'=>$records]);
	}

/**
 * Prepare a view for a new record or edit a current records if a id is provided in the URL
 *
 * @param $id mixed - primary id of the controllers default model (optional)
 *
 */
	public function detailsAction($id = null) {
		$data = ($id) ? $this->_edit_record($id) : $this->_new_record();

		ci('page')->render(null,(array)$data);
	}

/**
 * Call the controllers default model insert method with the posted form data
 *
 */
	public function indexPostAction() {
		$request = ci('input')->request();

		ci('event')->trigger('admin.controller.trait.index_post.'.$this->controller_model,$request,$this->controller_model);

		if ($request) {
			$this->data['primary_key'] = ci($this->controller_model)->insert($request);
		}

		$this->_rest_output();
	}

/**
 * Call the controllers default model update method with the posted form data
 *
 */
	public function indexPatchAction() {
		$request = ci('input')->request();

		ci('event')->trigger('admin.controller.trait.index.patch.'.$this->controller_model,$request,$this->controller_model);

		if ($request) {
			ci($this->controller_model)->update($request);
		}

		$this->_rest_output();
	}

/**
 * Call the controllers default model delete method with the posted form data's primary index
 *
 */
	public function indexDeleteAction() {
		$request = ci('input')->request();
		$primary_key = ci($this->controller_model)->get_primary_key();
		$id = hex2bin($request[$primary_key]);

		ci('event')->trigger('admin.controller.trait.index.delete.'.$this->controller_model,$request,$primary_key,$id,$this->controller_model);

		if ($id) {
			ci($this->controller_model)->delete($id);
		}

		$this->_rest_output();
	}

/**
 * Send out json rest data
 * used by, create, update, delete actions
 *
 */
	protected function _rest_output() {
		$this->data['ci_errors'] = ci('errors')->as_data();

		ci('event')->trigger('admin.controller.trait.rest.output.'.$this->controller_model,$this->data);

		ci('output')->json($this->data);
	}

/**
 * Setup the new records view data
 *
 * @return array
 */
	protected function _new_record() {
		$data = [
			'record'          => (object)[],
			'ci_title_prefix' => 'New',
			'form_method'     => 'post',
		];

		ci('event')->trigger('admin.controller.trait.data.new.record.'.$this->controller_model,$data);

		return $data;
	}

/**
 * Setup the edit records view data
 *
 * @param $id mixed - primary value of the controllers default model of the records to load for editing
 *
 * @return array
 */
	protected function _edit_record($id = null) {
		$id = hex2bin($id);
		$primary_key = ci($this->controller_model)->get_primary_key();
		$rules = ci($this->controller_model)->rule($primary_key,'rules');

		ci('event')->trigger('admin.controller.trait.validate.edit.record.'.$this->controller_model,$id,$primary_key,$rules);

		ci('validate')->variable($rules,$id)->die_on_fail();

		$data = [
			'record'          => ci($this->controller_model)->get($id),
			'ci_title_prefix' => 'Edit',
			'form_method'     => 'patch',
		];

		ci('event')->trigger('admin.controller.trait.data.edit.record.'.$this->controller_model,$data,$id,$primary_key);

		return $data;
	}
}
