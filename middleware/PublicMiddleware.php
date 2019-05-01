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
 * @version v2.0
 *
 * required
 * core:
 * libraries:
 * models:
 * helpers:
 * functions:
 *
 */
class PublicMiddleware extends \Middleware_base
{
	public function request(array $request) : array
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
		if (ci()->libraries) {
			ci('load')->library((array) ci()->libraries);
		}

		if (ci()->models) {
			ci('load')->model((array) ci()->models);
		}

		if (ci()->helpers) {
			ci('load')->helpers((array) ci()->helpers);
		}

		if (ci()->catalogs) {
			foreach (ci()->catalogs as $variable_name=>$args) {
				if (!is_array($args)) {
					$model_name = $args;
					$args = [];
				} else {
					$model_name = $args['model'];
				}

				ci('load')->model($model_name);

				$model_method = (isset($args['method'])) ? $args['method'] : 'catalog';

				if (method_exists(ci()->$model_name, $model_method)) {
					/* Are they calling the standard catalog for which we know all of the parameters to pass */
					if ($model_method == 'catalog') {
						/* we know the parameters */
						$with_deleted = @$args['with_deleted'];
						$ignore_read = @$args['ignore_read'];

						$catalog = ci()->$model_name->catalog(@$args['array_key'],@$args['select'],@$args['where'],@$args['order_by'],@$args['cache'],(bool)$with_deleted,(bool)$ignore_read);

						ci('load')->vars($variable_name,$catalog);
					} else {
						/* they are calling different method on the model to create the catalog - so we pass all of the parameters as an array */
						ci('load')->vars($variable_name, ci()->$model_name->$model_method($args));
					}
				} else {
					throw new \Exception('Method "'.$model_method.'" doesn\'t exist on "'.$model_name.'"');
				}
			}
		}

		if (ci()->controller_model) {
			ci('load')->model(strtolower(ci()->controller_model));
		}

		return $request;
	}
}
