<? pear::extends('_templates/orange_admin') ?>

<? pear::section('section_container') ?>

<? $tabs = pear::tab_prepare($tabs,$records,'group','description') ?>

<div class="row">
  <div class="col-md-6"><?=pear::title($controller_titles,'key') ?></div>
  <div class="col-md-6">
  	<div class="pull-right">
			<? if (user::can('url::/admin/permissions/post~index')) { ?>
				<?=pear::new_button($controller_path.'/details','New '.$controller_title) ?>
			<? } ?>
  	</div>
  </div>
</div>

<div class="row">
  <!-- Nav tabs -->
  <ul class="nav nav-pills js-tabs">
  	<? foreach (pear::tabs($tabs) as $tn) { ?>
		<li>
			<a href="#<?=pear::tab_id($tn) ?>" data-toggle="pill"><?=pear::tab_title($tn) ?></a>
		</li>
		<? } ?>
  </ul>
  
  <!-- tab panels -->
  <div class="tab-content">
  	<? foreach ($tabs as $tn=>$tab_set) { ?>
		<div class="tab-pane" id="<?=pear::tab_id($tn) ?>">
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
										<?=pear::edit_button($controller_path.'/details/'.$row->id) ?>
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

