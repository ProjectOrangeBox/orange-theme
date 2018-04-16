<?php

class Pear_bootstrap_wysiwyg extends Pear_plugin {

	public function __construct() {
		ci('page')
		->js([
			'/theme/orange/assets/plugins/bootstrap_wysiwyg/vendor/jquery.hotkeys.js',
			'/theme/orange/assets/plugins/bootstrap_wysiwyg/vendor/bootstrap-wysiwyg.js',
			'/theme/orange/assets/plugins/bootstrap_wysiwyg/plugin_bootstrap_wysiwyg.min.js',
		])
		->css('/theme/orange/assets/plugins/bootstrap_wysiwyg/plugin_bootstrap_wysiwyg.min.css');
	}

	public function render($name=null,$value=null,$extra=[]) {
		$extra = array_merge(['height'=>320,'toolbar'=>'default_toolbar'],$extra);

		$toolbar = ($toolbar_file = stream_resolve_include_path('libraries/plugins/bootstrap_wysiwyg_toolbars/'.$extra['toolbar'].'.php')) ? file_get_contents($toolbar_file) : '';

		$html  = '<div class="btn-toolbar wysiwyg-toolbar" data-role="editor-'.$name.'-toolbar" data-target="#wysiwyg-'.$name.'">';
		$html .= $toolbar;
		$html .= '</div>';
		$html .= '<div style="height: '.$extra['height'].'px" class="bootstrap-wysiwyg" id="wysiwyg-'.$name.'" data-textarea="'.$name.'" contenteditable="true">'.$value.'</div>';

		return $html;
	}

}
