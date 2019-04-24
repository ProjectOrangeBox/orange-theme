<?php

class Pear_bind extends \Pear_plugin
{
	public function __construct()
	{
		ci('page')->js('//cdn.jsdelivr.net/npm/tinybind@0.11.0/dist/tinybind.min.js',PAGE::PRIORITY_HIGHEST);

		ci('page')->js([
			'/theme/orange/assets/plugins/orangejax/tinybind.stdlib.min.js',
			'/theme/orange/assets/plugins/orangejax/app.min.js',
		]);
	}
}
