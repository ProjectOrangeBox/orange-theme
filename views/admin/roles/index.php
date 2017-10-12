<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<div class="row">
  <div class="col-md-6"><h3><i class="fa fa-users"></i> <?=$controller_titles ?></h3></div>
  <div class="col-md-6">
  	<div class="pull-right">
  		<?=html::search_sort_field() ?>
			<?=html::new_button($controller_path.'/details','New '.$controller_title) ?>
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
	<? foreach ($records as $r) { ?>
			<tr>
				<td><?=e($r->name) ?></td>
				<td><?=e($r->description) ?></td>
				<td class="text-center actions">
					<? if (user::has_role($r->edit_role_id)) { ?>
						<?=html::edit_button($controller_path.'/details/'.$r->id) ?>
					<? } ?>
					<? if (user::has_role($r->delete_role_id)) { ?>
						<?=html::delete_button($controller_path,['id'=>$r->id]) ?>
					<? } ?>
				</td>
			</tr>
	<? } ?>
		</tbody>
	</table>
</div>

<? page::end() ?>
