<?php
/**
 * $title
 * Insert description here
 *
 * @param $icon
 *
 * @return
 *
 * @access
 * @static
 * @throws
 * @example
 */
pear::attach('title',function($title,$icon=null) {
	return '<h3>'.(($icon) ? '<i class="fa fa-'.$icon.'"></i> '.$title : $title).'</h3>';
});
