<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 * @link http://summernote.org
 * @link http://cdnjs.com/libraries/summernote
 *
 */

class Pear_summernote {
	public function __construct() {
		pear::attach('summernote',function($name=null,$value=null,$extra=[]) {
			ci('page')->js([
					'//cdnjs.cloudflare.com/ajax/libs/codemirror/5.12.0/codemirror.min.js',
					'//cdnjs.cloudflare.com/ajax/libs/codemirror/5.12.0/mode/xml/xml.min.js',
					'//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js',
					'/theme/orange/assets/plugins/summer-note/summernote.js',
				])->css([
					'//cdnjs.cloudflare.com/ajax/libs/codemirror/5.12.0/codemirror.min.css',
					'//cdnjs.cloudflare.com/ajax/libs/codemirror/5.12.0/theme/eclipse.css',
					'//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css',
					'/theme/orange/assets/plugins/summer-note/summernote.min.css',
				]);
				$extra['class'] .= ' form-control summernote';
				return '<textarea id="'.$name.'" name="'.$name.'" '.ci('page')->convert2attributes($extra).'>'.$value.'</textarea>';
		});
	}
}