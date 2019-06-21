<?php pear::extends('_templates/orange_admin') ?>

<?php pear::section('section_container') ?>
<div class="row">
  <div class="col-md-6"><?=pear::title($controller_titles, 'user') ?></div>
  <div class="col-md-6">
  	<div class="pull-right">
  		<?=pear::table_search_field() ?>
			<?php if (pear::user('can', 'url::/admin/users::index~post')) { ?>
			<?=pear::new_button($controller_path.'/details', 'New '.$controller_title) ?>
  		<?php } ?>
  	</div>
  </div>
</div>
<div class="row">
		<table class="table table-sticky-header table-search table-sort table-hover">
			<thead>
				<tr class="panel-default">
					<th class="panel-heading">Username</th>
					<th class="panel-heading">Email</th>
					<th class="panel-heading text-center nosort">Active</th>
					<th class="panel-heading text-center nosort">Actions</th>
				</tr>
			</thead>
		<tbody>
		<?php foreach ($records as $row) { ?>
			<?php if (pear::user('has_role', $row->read_role_id)) { ?>
				<tr>
					<td><?=e($row->username) ?></td>
					<td><?=e($row->email) ?></td>
					<td class="text-center"><?=pear::fa_enum_icon($row->is_active) ?></td>
					<td class="text-center actions">
						<?php if (pear::user('has_role', $row->edit_role_id)) { ?>
							<?=pear::edit_button($controller_path.'/details/'.bin2hex($row->id)) ?>
						<?php } ?>
						<?php if (pear::user('has_role', $row->delete_role_id)) { ?>
							<?=pear::delete_button($controller_path, ['id'=>$row->id]) ?>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
		</tbody>
	</table>
</div>
<?php pear::end() ?>
