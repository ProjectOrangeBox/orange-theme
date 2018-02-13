<?php pear::extends('_templates/orange_admin') ?>
<?php pear::section('section_container') ?>
<?php $tabs = pear::tab_prepare($records,'group','name') ?>
<div class="row">
  <div class="col-md-6"><?=pear::title($controller_titles,'sliders') ?></div>
  <div class="col-md-6">
  	<div class="pull-right">
			<?php if (user::can('url::/admin/settings::index~post')) { ?>
				<?=pear::new_button($controller_path.'/details','New '.$controller_title) ?>
  		<?php } ?>
  	</div>
  </div>
</div>
<div class="row">
	<!-- Nav tabs -->
	<ul class="nav nav-pills js-tabs">
		<?php foreach (pear::tabs($tabs) as $tn) { ?>
		<li>
			<a href="#<?=pear::tab_id($tn) ?>" data-toggle="pill"><?=pear::tab_title($tn) ?></a>
		</li>
		<?php } ?>
	</ul>
	<!-- tab panels -->
	<div class="tab-content">
		<?php foreach ($tabs as $tn=>$tab_set) { ?>
		<div class="tab-pane" id="<?=pear::tab_id($tn) ?>">
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
					<?php if (user::has_role($row->read_role_id)) { ?>
						<tr>
							<td><?=e($row->name) ?></td>
							<td><?=e($row->group) ?></td>
							<td class="text-center actions">
								<?php if (user::has_role($row->edit_role_id)) { ?>
									<?=pear::edit_button($controller_path.'/editor/'.bin2hex($row->id)) ?>
								<?php } ?>
								<?php if (user::has_role(ADMIN_ROLE_ID)) {  ?>
									<a href="<?=$controller_path ?>/details/<?=bin2hex($row->id) ?>"><i class="fa fa-pencil-square fa-lg"></i></a>
								<?php } ?>
								<?php if (user::has_role($row->delete_role_id)) { ?>
									<?=pear::delete_button($controller_path,['id'=>$row->id]) ?>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
			</table>
		</div>
	<?php } ?>
</div>
<?php pear::end() ?>
