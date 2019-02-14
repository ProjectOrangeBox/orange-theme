<?php pear::extends('_templates/orange_admin') ?>

<?php pear::section('section_container') ?>

<?php $tabs = pear::tab_prepare($records, 'group', 'description') ?>

<div class="row">
  <div class="col-md-6"><?=pear::title($controller_titles, 'key') ?></div>
  <div class="col-md-6"></div>
</div>
<div class="row">
  <!-- Nav tabs -->
  <ul class="nav nav-pills js-tabs">
  	<?php foreach (pear::tabs($tabs) as $tn) {
	?>
		<li>
			<a href="#<?=pear::tab_id($tn) ?>" data-toggle="pill"><?=pear::tab_title($tn) ?></a>
		</li>
		<?php
} ?>
  </ul>
  <!-- tab panels -->
  <div class="tab-content">
  	<?php foreach ($tabs as $tn=>$tab_set) {
		?>
		<div class="tab-pane" id="<?=pear::tab_id($tn) ?>">
			<table class="table table-hover">
				<thead>
					<tr class="panel-default">
						<th class="panel-heading">Description</th>
						<th class="panel-heading">Key</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tab_set as $row) {
			?>
						<tr>
							<td><?=e($row->description) ?></td>
							<td><?=e($row->key) ?></td>
						</tr>
					<?php
		} ?>
				</tbody>
			</table>
		</div>
		<?php
	} ?>
</div>
<?php pear::end() ?>
