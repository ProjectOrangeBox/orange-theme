<?php
/**
 * LoginController
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
class LoginController extends \MY_Controller
{
	public $controller_path   = '/login';

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
	public function indexAction()
	{
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
	public function indexPostAction()
	{
		if (ci('auth')->login(ci('input')->request('email'), ci('input')->request('password'))) {
			redirect(site_url('{dashboard}'));
		}
		ci('wallet')->msg(ci('errors')->as_html('', '<br>'), 'red', $this->controller_path);
	}

	/**
	 * invertedAction
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
	public function invertedAction()
	{
		ci('auth')->logout();
		ci('wallet')->msg('Your are now logged out.', 'blue', site_url('{homepage}'));
	}
}
