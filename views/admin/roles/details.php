<? pear::extends('_templates/orange_admin') ?>

<? pear::section('section_container') ?>

<?=pear::open_multipart($controller_path,['class'=>'form-horizontal','method'=>$form_method,'data-success'=>'Record Saved|blue'],['id'=>$record->id]) ?>
	<div class="row">
		<div class="col-md-6"><h3><?=$ci_title_prefix ?> <?=$controller_title ?></h3></div>
	  <div class="col-md-6">
	  	<div class="pull-right">
				<?=pear::goback_button($controller_path) ?>
	  	</div>
	  </div>
	</div>

	<hr>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Name','name',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=pear::input('name',$record->name,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Description','description',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::input('description',$record->description,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- permissions -->

	<?php $tabs = pear::tab_prepare($tabs,$catalog_permissions,'group','description') ?>
	
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
			<?php foreach ($tab_set as $row) { ?>

				<!-- Checkbox -->
				<div class="col-md-4">
					<div class="checkbox">
						<label><?=pear::checkbox('permissions[]', $row->id, (array_key_exists($row->id,$permissions))) ?> <?=$row->description ?></label>
				  </div>
			  </div>

			<?php } ?>
		</div>
		<? } ?>
  </div>

	<!-- Submit Button -->
	<div class="form-group">
		<div class="col-md-12">
			<div class="pull-right">
				<?=pear::button(null,'Save',['class'=>'js-button-submit btn btn-primary']) ?>
			</div>
		</div>
	</div>

<?=pear::close() ?>

<? pear::end() ?>
