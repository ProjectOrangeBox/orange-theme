<? pear::extends('_templates/orange_admin') ?>

<? pear::section('section_container') ?>

<div class="row">
  <div class="col-md-6"><h3><i class="fa fa-bars"></i> Navigation</h3></div>
  <div class="col-md-6">
  	<div class="pull-right">
  		<?=pear::search_sort_field() ?>
			<? if (user::has_permission('url::/admin/configure/tooltips::index~post')) { ?>
				<?=pear::new_button($controller_path.'/details','New '.$controller_title) ?>
  		<? } ?>
  	</div>
  </div>
</div>

<div class="row">
	<table class="table orange sortable table-hover">
			<thead>
				<tr class="panel-default">
					<th class="panel-heading">Id</th>
					<th class="panel-heading"><?=pear::field_human('o_nav_model','text') ?></th>
					<th class="panel-heading"><?=pear::field_human('o_nav_model','url') ?></th>
					<th class="panel-heading">Parent</th>
					<th class="panel-heading text-center"><?=pear::field_human('o_nav_model','active') ?></th>
					<th class="panel-heading text-center">Actions</th>
				</tr>
			</thead>
		<tbody class="searchable">
			<? foreach ($records as $row) { ?>
			<tr>
				<td><?=e($row->id) ?></td>
				<td><?=e($row->text) ?></td>
				<td><?=e($row->url) ?></td>
				<td><?=pear::catalog_lookup('o_nav_model',$row->parent_id,'url') ?></td>
				<td class="text-center"><?=pear::fa_enum_icon($row->active) ?></td>
				<td class="text-center actions">
					<?=pear::edit_button($controller_path.'/details/'.bin2hex($row->id)) ?>
					<?=pear::delete_button($controller_path,['id'=>$row->id]) ?>
				</td>
			</tr>
			<? } ?>
		</tbody>
	</table>
</div>

<? pear::end() ?>
