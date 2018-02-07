<?php
/*
 * Orange Framework Extension
 *
 * @package	CodeIgniter / Orange
 * @author Don Myers
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ProjectOrangeBox
 *
 */

pear::attach('delete_button',function($uri='',$attributes=[]) {
	$name = ($attributes['primary_key']) ? $attributes['primary_key'] : 'id';
	$html  = '<form action="'.$uri.'" method="delete" data-confirm="true" data-fadeout="tr">';
	$html .= '<input type="hidden" name="'.$name.'" value="'.bin2hex($attributes[$name]).'">';
	$html .= '<a href="#" class="js-button-submit">';
	$html .= '<i class="fa fa-trash fa-lg" aria-hidden="true">';
	$html .= '</i>';
	$html .= '</a>';
	$html .= '</form>';
	return $html;
});
