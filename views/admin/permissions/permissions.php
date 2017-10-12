<?php
page::extends('_templates/orange_admin');
page::section('section_container');

echo '<h3>Users</h3>';

echo '<ul class="list-group">';

foreach ($users as $user) {
	echo '<li class="list-group-item">'.$user->username.' <img width="32" height="0">'.$user->email.' ('.$user->id.')</li>';

	echo '<ul>';

	if ($user->is_root) {
		echo '<li class="list-group-item"><strong>SuperUser</strong></li>';
	} else {
		echo '<li class="list-group-item"><strong>Roles</strong></li>';
	}

		echo '<ul>';
		
		foreach ($user->roles as $id=>$role) {
			echo '<li class="list-group-item">'.$role.' ('.$id.')</li>';
		}
	
		echo '</ul>';
	
	if (!$user->is_root) {
		echo '<li class="list-group-item"><strong>Permissions</strong></li>';
	}

		echo '<ul>';
		
		foreach ($user->permissions as $id=>$permission) {
			echo '<li class="list-group-item">'.$permission.' ('.$id.')</li>';
		}
		
		echo '</ul>';
		
	echo '</ul>';
}

echo '</ul>';

page::end();