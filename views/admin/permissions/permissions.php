<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<h3>Users</h3>

<ul class="list-group">

<? foreach ($users as $user) { ?>
	<li class="list-group-item"><strong><?=$user->username ?></strong></li>
		<ul>
			<li class="list-group-item"><strong>Details</strong></li>
				<ul>
			
				<? foreach ($user as $key=>$val) { ?>
						<li class="list-group-item"><?=$key ?>:<img width=16 height=0><?=o::convert_to_string($val) ?></li>
				<? } ?>
				
				</ul>
	
	<li class="list-group-item"><strong>Roles</strong></li>

	<ul>
	
	<? foreach ($user->roles as $id=>$role) { ?>
		<li class="list-group-item"><?=$id ?><img width=16 height=0><?=$role ?></li>
	<? } ?>
	
	</ul>
	
	<li class="list-group-item"><strong>Permissions</strong></li>
	
	<ul>
	
	<? foreach ($user->permissions as $id=>$permission) { ?>
		<li class="list-group-item"><?=$id ?><img width=16 height=0><?=$permission ?></li>
	<? } ?>

	</ul>
	
	</ul>
	
	<br>
<? } ?>

</ul>

<h3>Roles</h3>

<ul class="list-group">

<? foreach ($roles as $role) { ?>

	<li class="list-group-item"><strong><?=$role->name ?></strong></li>

	<ul>
		<li class="list-group-item"><strong>Details</strong></li>
			<ul>
		
			<? foreach ($role as $key=>$val) { ?>
					<li class="list-group-item"><?=$key ?>:<img width=16 height=0><?=o::convert_to_string($val) ?></li>
			<? } ?>
			
			</ul>

			<li class="list-group-item"><strong>Permissions</strong></li>
			
			<ul>
			
			<? foreach ($role->permissions as $permission) { ?>
				<li class="list-group-item"><?=$permission->id ?><img width=16 height=0><?=$permission->key ?></li>
			<? } ?>
		
			</ul>

	</ul>

<? } ?>

</ul>

<h3>Permissions</h3>

<ul class="list-group">

<? foreach ($permissions as $permission) { ?>

	<li class="list-group-item"><strong><?=$permission->description ?></strong></li>

	<ul>
		<li class="list-group-item"><strong>Details</strong></li>
		<ul>
	
		<? foreach ($permission as $key=>$val) { ?>
				<li class="list-group-item"><?=$key ?>:<img width=16 height=0><?=o::convert_to_string($val) ?></li>
		<? } ?>
		
		</ul>
	</ul>

<? } ?>

</ul>


<? page::end() ?>

<? page::section('page_style') ?>

.list-group-item {
  border-radius: 0 !important;
  padding: 4px 14px !important;
}

<? page::end() ?>