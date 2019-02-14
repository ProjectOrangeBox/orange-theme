<?php

class Pear_edit_button
{
	public function render($uri='', $attributes=[])
	{
		return anchor($uri, '<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>', $attributes);
	}
}
