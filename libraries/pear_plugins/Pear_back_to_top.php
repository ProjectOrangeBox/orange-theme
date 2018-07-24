<?php 

class Pear_back_to_top extends Pear_plugin {

	public function render() {
		return '<div class="back-to-top"><a onlick="javascript:posTop();" href="#">Back to top</a></div>';
	}

}