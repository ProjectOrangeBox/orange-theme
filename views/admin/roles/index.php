<?php pear::extends('_templates/orange_admin') ?>

<?php pear::section('section_container') ?>
<div class="row">
  <div class="col-md-6"><h3><i class="fa fa-users"></i> <?=$controller_titles ?></h3></div>
  <div class="col-md-6">
  	<div class="pull-right">
  		<?=pear::table_search_field() ?>
			<?php if (pear::user('can', 'url::/admin/roles::index~post')) {
	?>
				<?=pear::new_button($controller_path.'/details', 'New '.$controller_title) ?>
  		<?php
} ?>
  	</div>
  </div>
</div>
<div class="row">
		<table class="table table-sticky-header table-search table-sort table-hover">
			<thead>
				<tr class="panel-default">
					<th class="panel-heading">Name</th>
					<th class="panel-heading">Description</th>
					<th class="panel-heading text-center nosort">Actions</th>
				</tr>
			</thead>
		<tbody>
		<?php foreach ($records as $row) {
		?>
			<tr>
				<td><?=e($row->name) ?></td>
				<td><?=e($row->description) ?></td>
				<td class="text-center actions">
					<?=pear::edit_button($controller_path.'/details/'.bin2hex($row->id)) ?>
					<?=pear::delete_button($controller_path, ['id'=>$row->id]) ?>
				</td>
			</tr>
		<?php
	} ?>
		</tbody>
	</table>
</div>
<?php pear::end() ?>
