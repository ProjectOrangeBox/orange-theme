<? pear::extends('_templates/orange_admin') ?>

<? pear::section('section_container') ?>

<?php $tabs = pear::tab_prepare($tabs,$records,'group','name') ?>

<div class="row">
  <div class="col-md-6"><?=pear::title($controller_titles,'sliders') ?></div>
  <div class="col-md-6">
  	<div class="pull-right">
			<? if (user::can('url::/admin/settings/post~index')) { ?>
				<?=pear::new_button($controller_path.'/details','New '.$controller_title) ?>
  		<? } ?>
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
					<? if (user::has_role($row->read_role_id)) { ?>
						<tr>
							<td><?=e($row->name) ?></td>
							<td><?=e($row->group) ?></td>
							<td class="text-center actions">
								<? if (user::has_role($row->edit_role_id)) { ?>
									<?=pear::edit_button($controller_path.'/editor/'.$row->id) ?>
								<? } ?>
								
								<? if (user::has_role(config('auth.admin role id'))) { /* admin view */ ?>
									<a href="<?=$controller_path ?>/details/<?=$row->id ?>"><i class="fa fa-pencil-square fa-lg"></i></a>
								<? } ?>
								
								<? if (user::has_role($row->delete_role_id)) { ?>
									<?=pear::delete_button($controller_path,['id'=>$row->id]) ?>
								<? } ?>
							</td>
						</tr>
					<? } ?>
				<? } ?>
				</tbody>
			</table>
		</div>
	<? } ?>
</div>

<? pear::end() ?>
