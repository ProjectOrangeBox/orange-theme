<?php

/*
Add to controller

public function uploadPostAction() {
	ci('output')->json(ci('fupload')->process('uploader'));
}
*/

class Fupload {
	/*
	this handles the background uploading
	filenames are converted to a md5 hash and stored in a
	"safe" web inaccessible location until
	the form is processed at which point
	they can be renamed and moved to a final location
	sort of like the normal $_FILES
	*/
	public function process($user_config=null,$fieldname=null) {
		$config = $this->load_config($user_config,$fieldname);

		ci('upload')->initialize($config);

		$json = (ci('upload')->do_upload($config['fieldname'])) ? $this->upload_success($config) : $this->upload_error($config);

		/* clean upload folder */
		$this->clean_upload_folder($config['upload_path']);

		return $json;
	}

	public function move($user_config=null,$fieldname=null) {
		$config = $this->load_config($user_config,$fieldname);

		$field_contents = ci('input')->request($config['fieldname'].'-new','');

		$details_file = $config['upload_path'].$field_contents.'.upload';

		$success = false;

		if (file_exists($details_file)) {
			$data = json_decode(file_get_contents($details_file),true);

			if (is_array($data)) {
				if (file_exists($data['full_path'])) {
					$move_to = rtrim($config['move_to'],'/').'/'.$data['file_name'];

					/* remove the .raw file */
					if (rename($data['full_path'],$move_to)) {
						/* success is now the fieldname */
						$success = str_replace(WWW,'',$move_to);
					}
				}
			}
		}

		return $success;
	}

	public function clean_upload_folder($folder) {
		if (!file_exists($folder)) {
			throw new Exception('Upload folder not found.');
		}

		$files = glob($folder.'*');

		foreach ($files as $file) {
			if (is_file($file)) {
				if (time() - filemtime($file) >= 86400) {
					unlink($file);
				}
			}
		}
	}

	protected function load_config($user_config,$fieldname) {
		$default_config = config('upload');

		if (is_string($user_config)) {
			$fieldname = ($fieldname) ? $fieldname : $user_config;

			$user_config = config('upload.'.$user_config,[]);

			$user_config['fieldname'] = $fieldname;
		}

		return array_merge($default_config,$user_config);
	}

	protected function upload_error($config) {
		/* uploader error */
		$error = ci('upload')->display_errors();

		/* patch - fix wording */
		$error = str_replace('filetype','file type',$error);

		return [
			'error' => TRUE,
			'msg' => $error,
			'attached_id' => '',
			'filename' => '',
			'fieldname' => $config['fieldname'],
			'extra' => '',
		];
	}

	protected function upload_success($config) {
		$data = ci('upload')->data();

		$data['hash'] = md5_file($data['full_path']);

		/*
		["file_name"]=> string(40) "Screen_Shot_2018-03-21_at_4_14_03_PM.png"
		["file_type"]=> string(9) "image/png"
		["file_path"]=> string(29) "/var/www/www/app/var/uploads/"
		["full_path"]=> string(69) "/var/www/www/app/var/uploads/Screen_Shot_2018-03-21_at_4_14_03_PM.png"
		["raw_name"]=> string(36) "Screen_Shot_2018-03-21_at_4_14_03_PM"
		["orig_name"]=> string(40) "Screen_Shot_2018-03-21_at_4_14_03_PM.png"
		["client_name"]=> string(40) "Screen Shot 2018-03-21 at 4_14_03 PM.png"
		["file_ext"]=> string(4) ".png"
		["file_size"]=> float(365.3)
		["is_image"]=> bool(true)
		["image_width"]=> int(1956)
		["image_height"]=> int(938)
		["image_type"]=> string(3) "png"
		["image_size_str"]=> string(25) "width="1956" height="938""

		run our image library tests which include:
			file_size_max
			file_size_min
			max_width
			max_height
			min_width
			min_height
			exact_width
			exact_height
			max_dim
			min_dim
			exact_dim
		*/

		$success = true;

		foreach ($config as $method => $value) {
			if (method_exists(ci('image_lib'), $method)) {
				$success = ci('image_lib')->$method($data['full_path'], $value);

				if ($success !== true) {
					$json = [
						'error'       => true,
						'msg'         => $success,
						'attached_id' => '',
						'filename'    => '',
						'fieldname'   => $config['fieldname'],
						'extra'       => '',
					];

					break;
				}
			}
		}

		if ($success === true) {
			file_put_contents($data['file_path'].$data['hash'].'.upload', json_encode($data));

			$json = [
				'error' => false,
				'msg' => 'File Attached',
				'attached_id' => $data['hash'],
				'filename' => $data['client_name'],
				'fieldname' => $config['fieldname'],
				'extra' => '',
			];
		}

		return $json;
	}

} /* end class */
