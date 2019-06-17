<?php

class Pear_asset_merge extends \Pear_plugin
{
	public function __construct()
	{
		$routes = config('page.asset_merge',false);

		if (is_array($routes)) {
			$uri = trim(str_replace('/index', '',ci('router')->fetch_route()),'/');

			$match = false;

			foreach ($routes as $match=>$assets) {
				if (preg_match('#^'.$match.'$#im', $uri, $params, PREG_OFFSET_CAPTURE, 0)) {
					/* match found! */
					$match = $assets;
					/* leave for each loop */
					break;
				}
			}

			/* did we find a match? */
			if (is_array($match)) {
				/* does it contain any route css? */
				if (is_array($match['css'])) {
					foreach ($match['css'] as $css) {
						/* add it to the page */
						ci('page')->css($css);
					}
				}

				/* does it contain any route js? */
				if (is_array($match['js'])) {
					foreach ($match['js'] as $js) {
						/* add it to the page */
						ci('page')->js($js);
					}
				}

				/* does it contain any route plugins? */
				if (is_array($match['plugins'])) {
					foreach ($match['plugins'] as $plugin) {
						/* add it to the page */
						pear::plugin($plugin);
					}
				}

			}
		}
	} /* end render */

} /* end class */