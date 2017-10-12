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
		<?=html::label('Group','group',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::combobox('group',$record->group,$permissions_group_catalog) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Key','key',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::input('key',$record->key,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Description','description',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::input('description',$record->description,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
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
