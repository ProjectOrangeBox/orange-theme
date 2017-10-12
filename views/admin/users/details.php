<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>

<?=html::open_multipart($controller_path,['class'=>'form-horizontal','method'=>$form_method,'data-success'=>'Record Saved|blue'],['id'=>$record->id]) ?>
	<div class="row">
		<div class="col-md-6"><?=html::title($ci_title_prefix.' '.$controller_title,'user') ?></div>
		<div class="col-md-6">
			<div class="pull-right">
				<?=html::goback_button($controller_path) ?>
			</div>
		</div>
	</div>

	<hr>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Email','email',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::input('email',$record->email,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<div class="form-group">
		<?=html::label('Username','username',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::input('username',$record->username,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Password input-->
	<div class="form-group">
		<?=html::label('Password','password',['class'=>'col-md-3 control-label '.(($form_method != 'post') ? '' : 'required')]) ?>
		<div class="col-md-4">
			<?=html::password('password','',['class'=>'form-control input-md','autocomplete'=>'off']) ?>
  		<p class="help-block"><?=config('auth.password copy') ?></p>
			<? if ($form_method != 'post') { ?>
			<p class="help-block">Leave blank to leave password unchanged.</p>
			<? } ?>
		</div>
	</div>

	<!-- Password input-->
	<div class="form-group">
		<?=html::label('Confirm Password','confirm_password',['class'=>'col-md-3 control-label '.(($form_method != 'post') ? '' : 'required')]) ?>
		<div class="col-md-4">
			<?=html::password('confirm_password','',['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4 col-md-offset-3">
			<h4>Record Permissions <small>(umask)</small></h4>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=html::label('Read','user_read_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::dropdown('user_read_role_id',$roles_catalog,$record->user_read_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=html::label('Edit','user_edit_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::dropdown('user_edit_role_id',$roles_catalog,$record->user_edit_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=html::label('Delete','user_delete_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::dropdown('user_delete_role_id',$roles_catalog,$record->user_delete_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-4 col-md-offset-3">
			<h4>Permissions</h4>
		</div>
	</div>

	<!-- Select Multiple -->
	<div class="form-group">
		<?=html::label('Roles','roles',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::dropdown('roles[]',$roles_catalog,array_keys((array)$record->roles),['class'=>'form-control select3','multiple'=>'multiple']) ?>
		</div>
	</div>

	<!-- Checkbox -->
	<div class="form-group">
		<div class="col-md-offset-3 col-md-4">
			<div class="checkbox">
				<label>
					<?=html::checkbox('is_active', 1, ($record->is_active == 1),['class'=>'js-checker']) ?> Active
				</label>
			</div>
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
