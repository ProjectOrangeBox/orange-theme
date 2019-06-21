<?php
/**
 * NavMiddleware
 * Do the find and replace on the navigation html
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
class NavbarMiddleware extends \Middleware_base
{
	public function response(string $output = '') : string
	{
		if (preg_match_all('/<li(.*){username}(.*)<\/li>/m', $output, $matches, PREG_SET_ORDER, 0)) {
			$output = str_replace($matches[1].'{username}'.$matches[2], ci('user')->username, $output);
		}

		if (preg_match_all('/<li(.*){email}(.*)<\/li>/m', $output, $matches, PREG_SET_ORDER, 0)) {
			$output = str_replace($matches[1].'{email}'.$matches[2], ci('user')->email, $output);
		}

		return $output;
	}

}
