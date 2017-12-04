<?php
/*
http://mindmup.github.io/bootstrap-wysiwyg/
https://github.com/mindmup/bootstrap-wysiwyg/
*/
class Plugin_bootstrap_wysiwyg {
	public function __construct() {
		pear::attach('bootstrap_wysiwyg',function($name=null,$value=null,$extra=[]) {
			ci()->page->js([
				'/theme/orange/assets/plugins/bootstrap_wysiwyg/vendor/jquery.hotkeys.js',
				'/theme/orange/assets/plugins/bootstrap_wysiwyg/vendor/bootstrap-wysiwyg.js',
				'/theme/orange/assets/plugins/bootstrap_wysiwyg/plugin_bootstrap_wysiwyg.min.js',
			])->css('/theme/orange/assets/plugins/bootstrap_wysiwyg/plugin_bootstrap_wysiwyg.min.css');
	
			$extra = array_merge(['height'=>320,'toolbar'=>'default_toolbar'],$extra);

			$toolbar = ($toolbar_file = stream_resolve_include_path('libraries/plugins/bootstrap_wysiwyg_toolbars/' . $extra['toolbar'] . '.php')) ? file_get_contents($toolbar_file) : '';
	
			$html  = '<div class="btn-toolbar wysiwyg-toolbar" data-role="editor-'.$name.'-toolbar" data-target="#wysiwyg-'.$name.'">';
			$html .= $toolbar;
			$html .= '</div>';
			$html .= '<div style="height: '.$extra['height'].'px" class="bootstrap-wysiwyg" id="wysiwyg-'.$name.'" data-textarea="'.$name.'" contenteditable="true">'.$value.'</div>';
			
			return $html;
		});
	}
} /* end class */


/*
	static public function input($name,$value,$extra) {
		$toolbar = (empty($extra['toolbar'])) ? file_get_contents(__DIR__.'/default_toolbar.php') : ci()->load->view($extra['toolbar'],[],true);

		echo '<div class="btn-toolbar wysiwyg-toolbar" data-role="editor-'.$name.'-toolbar" data-target="#wysiwyg-'.$name.'">';
		echo $toolbar;
		echo '</div>';
		echo '<div style="height: '.$extra['height'].'px" class="bootstrap-wysiwyg" id="wysiwyg-'.$name.'" data-textarea="'.$name.'" contenteditable="true">'.$value.'</div>';
	}
*/