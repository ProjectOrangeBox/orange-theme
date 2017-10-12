<?php
/**
* Orange Framework Extension
*
* This content is released under the MIT License (MIT)
*
* @package	CodeIgniter / Orange
* @author	Don Myers
* @license	http://opensource.org/licenses/MIT	MIT License
* @link	https://github.com/dmyers2004
*/
/*
Sample Config values in config/email.php

$config['protocol'] = 'filesystem';
$config['mailpath'] = ROOTPATH.'/support/email';
$config['mailtype'] = 'html';
*/

class MY_Email extends CI_Email {
	/* add filesystem as a selectable protocol */
	protected $_protocols = array('mail', 'sendmail', 'smtp', 'filesystem_json','filesystem_eml');

	/**
	 * Drop JSON email into folder
	 *
	 * @return	bool
	 */
	protected function _send_with_filesystem_json() {
		$eml = json_encode(['headers'=>$this->_headers,'finalbody'=>$this->_finalbody],JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

		if ($success = file_put_contents($this->mailpath.'/'.md5($eml).'.eml',$eml,LOCK_EX)) {
			log_message('error', 'MY_Email::_send_with_filesystem() could not open file write handle');
		}

		return $success;
	}

	protected function _send_with_filesystem_eml() {
		$eml = '';

		foreach ($this->_headers as $key=>$val) {
			$eml .= $key.': '.$val.chr(10);
		}

		$eml .= $this->_finalbody.chr(10);

		if ($success = file_put_contents($this->mailpath.'/'.md5($eml).'.eml',$eml,LOCK_EX)) {
			log_message('error', 'MY_Email::_send_with_filesystem() could not open file write handle');
		}

		return $success;
	}

} /* end class */