<?php
/**
 * PublicMiddleware
 * Insert description here
 *
 * @package CodeIgniter / Orange
 * @author Don Myers
 * @copyright 2018
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @version 2.0
 *
 * required
 * core:
 * libraries:
 * models:
 * helpers:
 * functions:
 *
 */
class PublicMiddleware extends Middleware_base {
	public function request() : void
	{
		/**
		 * Autoload:
		 * Libraries
		 * Models
		 * Helpers
		 * Model catalogs
		 * Controller Default Model
		 *
		 * This really isn't needed anymore with the use of ci() which will autoload if it's not already loaded
		 */
		if ($this->libraries) {
			$this->load->library((array) $this->libraries);
		}

		if ($this->models) {
			$this->load->model((array) $this->models);
		}

		if ($this->helpers) {
			$this->load->helpers((array) $this->helpers);
		}

		if ($this->catalogs) {
			foreach ($this->catalogs as $variable_name=>$args) {
				if (!is_array($args)) {
					$model_name = $args;
					$args = [];
				} else {
					$model_name = $args['model'];
				}

				$this->load->model($model_name);

				$model_method = (isset($args['method'])) ? $args['method'] : 'catalog';

				if (method_exists($this->$model_name,$model_method)) {
					if ($model_method == 'catalog') {
						$this->load->vars($variable_name, $this->$model_name->$model_method(@$args['array_key'],@$args['select'],@$args['where'],@$args['order_by'],@$args['cache'],@$args['with_deleted']));
					} else {
						$this->load->vars($variable_name, $this->$model_name->$model_method($args));
					}
				} else {
					throw new Exception('Method "'.$model_method.'" doesn\'t exist on "'.$model_name.'"');
				}
			}
		}

		if ($this->controller_model) {
			$this->load->model(strtolower($this->controller_model));
		}

	}
}
