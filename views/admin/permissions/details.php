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
		<?=pear::field_label('o_permission_model','group') ?>
		<div class="col-md-4">
			<?=pear::combobox('group',$record->group,$permissions_group_catalog) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::field_label('o_permission_model','key') ?>
		<div class="col-md-4">
			<?=pear::input('key',$record->key,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
  		<p class="help-block">Use extreme caution when changing this value.</p>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::field_label('o_permission_model','description') ?>
		<div class="col-md-4">
			<?=pear::input('description',$record->description,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<?=pear::include('_templates/access') ?>
				
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
