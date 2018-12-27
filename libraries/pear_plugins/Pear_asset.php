<?php

// @show auto asset url generator

class Pear_asset extends Pear_plugin {

	public function render($url=null,$attributes=null)
	{
		$html = '';

		$pathinfo = pathinfo($url);

		$attr = $this->attributes($attributes);

		switch ($pathinfo['extension']) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'gif':
			case 'jpg':
				$html = '<img src="'.$url.'"'.$attr.'>';
			break;
			case 'css':
				$html = '<link rel="stylesheet" href="'.$url.'"'.$attr.'>';
			break;
			case 'js':
				$html = '<script src="'.$url.'"'.$attr.'></script>';
			break;
		}

		return $html;
	}

	protected function attributes($attributes)
	{
		$attr = '';

		if (is_string($attributes)) {
			$attr = ' '.$attributes;
		} elseif (is_array($attributes)) {
			foreach ($attributes as $key=>$val) {
				$attr .= ' '.$key.'="'.$val.'"';
			}
		}

		return $attr;
	}

}
