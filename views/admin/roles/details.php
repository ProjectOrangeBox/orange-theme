<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<?=html::open_multipart($controller_path,['class'=>'form-horizontal','method'=>$form_method,'data-success'=>'Record Saved|blue'],['id'=>$record->id]) ?>
	<div class="row">
		<div class="col-md-6"><h3><?=$ci_title_prefix ?> <?=$controller_title ?></h3></div>
	  <div class="col-md-6">
	  	<div class="pull-right">
				<?=html::goback_button($controller_path) ?>
	  	</div>
	  </div>
	</div>

	<hr>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Name','name',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::input('name',$record->name,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Description','description',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::input('description',$record->description,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- permissions -->

	<?php $tabs = html::tab_prepare($tabs,$catalog_permissions,'group','description') ?>
	
  <!-- Nav tabs -->
  <ul class="nav nav-pills js-tabs">
  	<?php foreach (html::tabs($tabs) as $tn) { ?>
		<li>
			<a href="#<?=html::tab_id($tn) ?>" data-toggle="pill"><?=html::tab_title($tn) ?></a>
		</li>
		<?php } ?>
  </ul>

  <!-- tab panels -->
  <div class="tab-content">
  	<?php foreach ($tabs as $tn=>$tab_set) { ?>
		<div class="tab-pane" id="<?=html::tab_id($tn) ?>">
			<?php foreach ($tab_set as $row) { ?>

				<!-- Checkbox -->
				<div class="col-md-3">
					<div class="checkbox">
						<label><?=html::checkbox('permissions[]', $row->id, (array_key_exists($row->id,$permissions))) ?> <?=$row->description ?></label>
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
				<?=html::button(null,'Save',['class'=>'js-button-submit btn btn-primary']) ?>
			</div>
		</div>
	</div>

<?=html::close() ?>

<? page::end() ?>
