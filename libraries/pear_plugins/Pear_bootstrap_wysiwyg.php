<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @link http://mindmup.github.io/bootstrap-wysiwyg/
 * @link https://github.com/mindmup/bootstrap-wysiwyg/
 *
 */

pear::attach('bootstrap_wysiwyg',function($name=null,$value=null,$extra=[]) {
	ci('page')->js([
		'/theme/orange/assets/plugins/bootstrap_wysiwyg/vendor/jquery.hotkeys.js',
		'/theme/orange/assets/plugins/bootstrap_wysiwyg/vendor/bootstrap-wysiwyg.js',
		'/theme/orange/assets/plugins/bootstrap_wysiwyg/plugin_bootstrap_wysiwyg.min.js',
	])->css('/theme/orange/assets/plugins/bootstrap_wysiwyg/plugin_bootstrap_wysiwyg.min.css');

	$extra = array_merge(['height'=>320,'toolbar'=>'default_toolbar'],$extra);
	$toolbar = ($toolbar_file = stream_resolve_include_path('libraries/plugins/bootstrap_wysiwyg_toolbars/'.$extra['toolbar'].'.php')) ? file_get_contents($toolbar_file) : '';
	$html  = '<div class="btn-toolbar wysiwyg-toolbar" data-role="editor-'.$name.'-toolbar" data-target="#wysiwyg-'.$name.'">';
	$html .= $toolbar;
	$html .= '</div>';
	$html .= '<div style="height: '.$extra['height'].'px" class="bootstrap-wysiwyg" id="wysiwyg-'.$name.'" data-textarea="'.$name.'" contenteditable="true">'.$value.'</div>';

	return $html;
});
