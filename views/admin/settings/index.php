<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<?php $tabs = plugin::tab_prepare($tabs,$records,'group','name') ?>

<div class="row">
  <div class="col-md-6"><?=plugin::title($controller_titles,'sliders') ?></div>
  <div class="col-md-6">
  	<div class="pull-right">
			<?=plugin::new_button($controller_path.'/details','New '.$controller_title) ?>
  	</div>
  </div>
</div>

<div class="row">
	<!-- Nav tabs -->
	<ul class="nav nav-pills js-tabs">
		<?php foreach (plugin::tabs($tabs) as $tn) { ?>
		<li>
			<a href="#<?=plugin::tab_id($tn) ?>" data-toggle="pill"><?=plugin::tab_title($tn) ?></a>
		</li>
		<?php } ?>
	</ul>

	<!-- tab panels -->
	<div class="tab-content">
		<?php foreach ($tabs as $tn=>$tab_set) { ?>
		<div class="tab-pane" id="<?=plugin::tab_id($tn) ?>">
			<table class="table orange table-hover">
				<thead>
					<tr class="panel-default">
						<th class="panel-heading">Name</th>
						<th class="panel-heading">Group</th>
						<th class="panel-heading text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tab_set as $row) { ?>
					<tr>
						<td><?=e($row->name) ?></td>
						<td><?=e($row->group) ?></td>
						<td class="text-center actions">
							<?=plugin::edit_button($controller_path.'/editor/'.$row->id) ?>
							<? if (user::has_role($row->edit_role_id)) { ?>
								<a href="<?=$controller_path ?>/details/<?=$row->id ?>"><i class="fa fa-pencil-square fa-lg"></i></a>
							<? } ?>
							<? if (user::has_role($row->delete_role_id)) { ?>
								<?=plugin::delete_button($controller_path,['id'=>$row->id]) ?>
							<? } ?>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
		</div>
	<? } ?>
</div>

<? page::end() ?>
