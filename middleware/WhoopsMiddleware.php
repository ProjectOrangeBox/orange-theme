<?php
/**
 * GuiMiddleware
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
use Whoops\Handler\PrettyPageHandler;

class WhoopsMiddleware extends \Middleware_base
{
	public function request(array $request) : array
	{
		if ($_ENV['DEBUG'] == 'development') {
			$whoops = new \Whoops\Run;
			$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
			$whoops->register();
		}

		return $request;
	}
}
