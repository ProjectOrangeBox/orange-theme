<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<? $tabs = plugin::tab_prepare($tabs,$records,'group','description') ?>

<div class="row">
  <div class="col-md-6"><?=plugin::title($controller_titles,'key') ?></div>
  <div class="col-md-6">
  	<div class="pull-right">
			<?=plugin::new_button($controller_path.'/details','New '.$controller_title) ?>
  	</div>
  </div>
</div>

<div class="row">
  <!-- Nav tabs -->
  <ul class="nav nav-pills js-tabs">
  	<? foreach (plugin::tabs($tabs) as $tn) { ?>
		<li>
			<a href="#<?=plugin::tab_id($tn) ?>" data-toggle="pill"><?=plugin::tab_title($tn) ?></a>
		</li>
		<? } ?>
  </ul>
  
  <!-- tab panels -->
  <div class="tab-content">
  	<? foreach ($tabs as $tn=>$tab_set) { ?>
		<div class="tab-pane" id="<?=plugin::tab_id($tn) ?>">
			<table class="table table-hover orange">
				<thead>
					<tr class="panel-default">
						<th class="panel-heading">Description</th>
						<th class="panel-heading">Key</th>
						<th class="panel-heading text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<? foreach ($tab_set as $row) { ?>
					<? if (user::has_role($row->read_role_id)) { ?>
						<tr>
							<td><?=e($row->description) ?></td>
							<td><?=e($row->key) ?></td>
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
		<? } ?>

</div>

<? page::end() ?>

