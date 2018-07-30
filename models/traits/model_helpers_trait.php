<?php

trait model_helper_trait {
	/**
	 * add_soft_delete_default_columns
	 * Insert description here
	 *
	 * @param $tablename
	 * @param $connection
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
		public function add_soft_delete_default_columns($tablename,$connection='default') {
			$db = load_config('database','db');
	
			$config = $db[$connection];
			$mysqli = new mysqli($config['hostname'],$config['username'],$config['password'],$config['database']);
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN is_deleted TINYINT(1) UNSIGNED NULL DEFAULT 0');
			echo 'finished';
		}
	
	/**
	 * add_role_default_columns
	 * Insert description here
	 *
	 * @param $tablename
	 * @param $connection
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
		public function add_role_default_columns($tablename=null,$connection='default') {
			$tablename = ($tablename) ? $tablename : $this->table;
	
			$db = load_config('database','db');
	
			$config = $db[$connection];
			$mysqli = new mysqli($config['hostname'],$config['username'],$config['password'],$config['database']);
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN read_role_id INT(11) UNSIGNED NULL DEFAULT '.ADMIN_ROLE_ID);
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN edit_role_id INT(11) UNSIGNED NULL DEFAULT '.ADMIN_ROLE_ID);
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN delete_role_id INT(11) UNSIGNED NULL DEFAULT '.ADMIN_ROLE_ID);
			echo '<p>finished</p>';
		}
	
	/**
	 * add_stamp_default_columns
	 * Insert description here
	 *
	 * @param $tablename
	 * @param $connection
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
		public function add_stamp_default_columns($tablename=null,$connection='default') {
			$tablename = ($tablename) ? $tablename : $this->table;
			
			$db = load_config('database','db');
					
			$config = $db[$connection];
			$mysqli = new mysqli($config['hostname'],$config['username'],$config['password'],$config['database']);
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN created_on DATETIME NULL DEFAULT NULL');
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN created_by INT(11) UNSIGNED NULL DEFAULT '.NOBODY_USER_ID);
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN created_ip VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT \'0.0.0.0\'');
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN updated_on DATETIME NULL DEFAULT NULL');
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN updated_by INT(11) UNSIGNED NULL DEFAULT '.NOBODY_USER_ID);
			$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN updated_ip VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT \'0.0.0.0\'');
			if ($this->has_soft_delete) {
				$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN deleted_on DATETIME NULL DEFAULT NULL');
				$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN deleted_by INT(11) UNSIGNED NULL DEFAULT '.NOBODY_USER_ID);
				$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN deleted_ip VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT \'0.0.0.0\'');
				$mysqli->query('ALTER TABLE `'.$tablename.'` ADD COLUMN is_deleted TINYINT(1) UNSIGNED NULL DEFAULT 0');
			}
			echo '<p>finished</p>';
		}
	
	 /**
		* Insert description here
		*
		* @param array $data list of data to test
		* @param array $only_columns list of only the columns you want to check. if left empty all columns in $data tested
		*
		* @return boolean|array false if no changes or associated list of columns changed. list key contains the column name and list value contain the old value
		*
		*/
		protected function find_changed_columns($data,$only_columns=false) {
			$changed = false;
			$data = (array)$data;
		
			if (!isset($data[$this->primary_key])) {
				throw new Exception('Database Model update primary key missing');
			}
		
			$old_data = (array)$this->get($data[$this->primary_key]);
			$columns = (is_array($only_columns)) ? $only_columns : array_keys($data);
		
			foreach ($columns as $column) {
				if ($data[$column] != $old_data[$column]) {
					$changed[$column] = $old_data[$column];
				}
			}
		
			return $changed;
		}

	/**
	 * build_sql_boolean_match
	 * Insert description here
	 *
	 * @param $column_name
	 * @param $match
	 * @param $not_match
	 *
	 * @return
	 *
	 * @access
	 * @static
	 * @throws
	 * @example
	 */
		public function build_sql_boolean_match($column_name, $match = null, $not_match = null) {
			$sql = false;
			$match_where = '';
	
			if (is_array($match) > 0) {
				$match_where .= ' +'.implode(' +', $match);
			}
	
			if (is_array($not_match) > 0) {
				$match_where .= ' -'.implode(' -', $not_match);
			}
	
			if (!empty($match_where)) {
				$sql = "match(`".$column_name."`) against('".trim($match_where)."' in boolean mode)";
			}
	
			return $sql;
		}

	} /* end trait */
