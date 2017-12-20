<?php
/* display flash / growl style messesages
based on the wallet_messages content
*/
/*
take what was stored by the wallet library and format it
this allows this plugin loosely coupled to the flash_msg library
the library only formats the view variable
this plugin then can be used or changed to show it in what ever way is needed
*/
class Plugin_flash_msg {

	public function __construct() {
		$msgs = [];
	
		/* grab the payload sent in from wallet */
		$payload = (array)ci()->load->get_var('wallet_messages');
	
		/* bootstrap mapping */
		$types = [
			'green'   => 'success',
			'red'     => 'danger',
			'yellow'  => 'warning',
			'blue'    => 'info',
			'success' => 'success',
			'error'   => 'danger',
			'block'   => 'warning',
			'info'    => 'info',
			'primary' => 'primary',
			'warning' => 'warning',
			'danger'  => 'danger',
		];
	
		/* does the payload actually contain anything? */
		if (is_array($payload['messages'])) {
			/* build javascript to show the dialogs */
			foreach ($payload['messages'] as $msg) {
	
				$msg = ['text'=>$msg['msg'],'stay'=>$msg['sticky'],'type'=>$types[$msg['type']]];
	
				if ($msg['sticky'] == true) {
					$msg['staytime'] = ($payload['pause_for_each'] * ($payload['initial_pause']++));
				}
	
				$msgs[] = $msg;
			}
		}
	
		/* add this to every page because they may want to trigger msgs client side via javascript */
		ci()->page
			->js_variable('messages',(array)$msgs)
			->css('/theme/orange/assets/plugins/flash-msg/flash-msg.css')
			->js('/theme/orange/assets/plugins/flash-msg/jquery.bootstrap.flash-msg.js');
	
	}

} /* end class */