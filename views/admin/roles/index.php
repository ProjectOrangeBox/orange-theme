<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<div class="row">
  <div class="col-md-6"><h3><i class="fa fa-users"></i> <?=$controller_titles ?></h3></div>
  <div class="col-md-6">
  	<div class="pull-right">
  		<?=plugin::search_sort_field() ?>
			<?=plugin::new_button($controller_path.'/details','New '.$controller_title) ?>
  	</div>
  </div>
</div>

<div class="row">
	<table class="table orange sortable table-hover">
			<thead>
				<tr class="panel-default">
					<th class="panel-heading">Name</th>
					<th class="panel-heading">Description</th>
					<th class="panel-heading text-center">Actions</th>
				</tr>
			</thead>
		<tbody class="searchable">
		<? foreach ($records as $row) { ?>
			<? if (user::has_role($row->read_role_id)) { ?>
				<tr>
					<td><?=e($row->name) ?></td>
					<td><?=e($row->description) ?></td>
					<td class="text-center actions">
						<? if (user::has_role($row->edit_role_id)) { ?>
							<?=plugin::edit_button($controller_path.'/details/'.$row->id) ?>
						<? } ?>
						<? if (user::has_role($row->delete_role_id)) { ?>
							<?=plugin::delete_button($controller_path,['id'=>$row->id]) ?>
						<? } ?>
					</td>
				</tr>
			<? } ?>
		<? } ?>
		</tbody>
	</table>
</div>

<? page::end() ?>
