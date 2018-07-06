<?php
/**
* Orange Framework Extension
*
* This content is released under the MIT License (MIT)
*
* @package	CodeIgniter / Orange
* @author	Don Myers
* @license http://opensource.org/licenses/MIT MIT License
* @link	https://github.com/ProjectOrangeBox
*
CREATE TABLE `orange_nav` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`created_on` timestamp NULL DEFAULT NULL,
	`created_by` int(11) unsigned NOT NULL DEFAULT '1',
	`created_ip` varchar(16) DEFAULT NULL,
	`updated_on` timestamp NULL DEFAULT NULL,
	`updated_by` int(11) unsigned NOT NULL DEFAULT '1',
	`updated_ip` varchar(16) DEFAULT NULL,
	`is_editable` tinyint(1) unsigned NOT NULL DEFAULT '1',
	`is_deletable` tinyint(1) unsigned NOT NULL DEFAULT '1',
	`url` varchar(255) NOT NULL DEFAULT '',
	`text` varchar(255) NOT NULL DEFAULT '',
	`access_id` int(11) unsigned NOT NULL DEFAULT '1',
	`parent_id` int(11) unsigned NOT NULL DEFAULT '0',
	`sort` int(11) unsigned NOT NULL DEFAULT '0',
	`target` varchar(128) DEFAULT NULL,
	`class` varchar(32) DEFAULT '',
	`active` tinyint(1) unsigned NOT NULL DEFAULT '1',
	`color` varchar(7) NOT NULL DEFAULT 'd28445',
	`icon` varchar(32) NOT NULL DEFAULT 'square',
	`internal` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
*
* required
* core: session, load, input
* libraries: event
* models:
* helpers:
* functions: setting
*
*/
class O_nav_model extends Database_model {
	protected $table = 'orange_nav';
	protected $rules = [
		'id'           => ['field' => 'id', 'label' => 'Id', 'rules' => 'required|integer|max_length[10]|less_than[4294967295]|filter_int[10]'],
		'url'          => ['field' => 'url', 'label' => 'URL', 'rules' => 'required|is_uniquem[o_nav_model.url.id]|filter_uri[255]|max_length[255]|filter_input[255]|strtolower'],
		'text'         => ['field' => 'text', 'label' => 'Text', 'rules' => 'required|max_length[255]|filter_input[255]'],
		'parent_id'    => ['field' => 'parent_id', 'label' => 'Parent Id', 'rules' => 'if_empty[0]|integer|max_length[10]|less_than[4294967295]|filter_int[10]'],
		'sort'         => ['field' => 'sort', 'label' => 'Sort', 'rules' => 'if_empty[0]|integer|max_length[10]|less_than[4294967295]|filter_int[10]'],
		'access'       => ['field' => 'access', 'label' => 'Permission', 'rules' => 'required|integer|max_length[10]|less_than[4294967295]|filter_int[10]'],
		'class'        => ['field' => 'class', 'label' => 'Class', 'rules' => 'filter_input[32]'],
		'active'       => ['field' => 'active', 'label' => 'Active', 'rules' => 'if_empty[0]|in_list[0,1]|filter_int[1]|max_length[1]|less_than[2]'],
		'color'        => ['field' => 'color', 'label' => 'Color', 'rules' => 'if_empty[d28445]|filter_hex[6]|max_length[6]|filter_input[6]'],
		'icon'         => ['field' => 'icon', 'label' => 'Icon', 'rules' => 'if_empty[square]|max_length[32]|filter_input[32]'],
		'target'       => ['field' => 'target', 'label' => 'Target', 'rules' => 'filter_input[128]'],
	];
	protected $has_roles = true;
	protected $has_stamps = true;
	protected $order_by = 'url sort';

	public function grouped_by_parents() {
		$that = &$this;

		return cache('nav_library.'.$this->cache_prefix.'.user'.user::id(),function() use ($that) {
			$ary = [];

			$access = [0] + array_keys(user::permissions());

			$records = $that->as_array()->where_in('access',$access)->where(['active'=>1])->order_by('parent_id, sort')->get_many();

			foreach ($records as $record) {
				$ary[$record['parent_id']][] = $record;
			}

			return $ary;
		});

	}

	public function add($url=null,$text=null,$internal=null) {
		foreach (func_get_args() as $v) {
			if (empty($v)) {
				throw new exception(__METHOD__.' Required Field Empty.'.chr(10));
			}
		}

		$this->skip_rules = true;

		$defaults = [
			'read_role_id'=>ADMIN_ROLE_ID,
			'edit_role_id'=>ADMIN_ROLE_ID,
			'delete_role_id'=>ADMIN_ROLE_ID,
			'created_on'=>date('Y-m-d H:i:s'),
			'created_by'=>0,
			'created_ip'=>'0.0.0.0',
			'updated_on'=>date('Y-m-d H:i:s'),
			'updated_by'=>0,
			'updated_ip'=>'0.0.0.0',
		];

		/* we already verified the key that's the "real" primary key */
		return (!$this->exists(['internal'=>$internal])) ? $this->insert($defaults + ['url'=>$url,'text'=>$text,'internal'=>$internal]) : false;
	}

} /* end class */
