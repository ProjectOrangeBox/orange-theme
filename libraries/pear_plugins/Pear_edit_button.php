<?php

/* deprecated please use button_edit */
pear::attach('edit_button',function($uri='',$attributes=[]) {
	return anchor($uri,'<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>',$attributes);
});
