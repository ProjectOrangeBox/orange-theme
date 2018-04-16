<?php

class Pear_  extends Pear_plugin {

	public function render($color=null,$with_hash=true) {
		return(($with_hash) ? '#' : '').trim($color, '#');
	}
}
