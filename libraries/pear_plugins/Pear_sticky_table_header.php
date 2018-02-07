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

ci('page')
	->js('/theme/orange/assets/plugins/orange-sticky-table-header/jquery.stickytableheaders.min.js')
	->domready("$('table.orange').stickyTableHeaders({fixedOffset: $('.page-header.navbar.navbar-fixed-top')});");
