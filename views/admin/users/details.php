<?php pear::extends('_templates/orange_admin') ?>
<?php pear::section('section_container') ?>
<?=pear::open_multipart($controller_path,['class'=>'form-horizontal','method'=>$form_method,'data-success'=>'Record Saved|blue'],['id'=>$record->id]) ?>
	<div class="row">
		<div class="col-md-6"><?=pear::title($ci_title_prefix.' '.$controller_title,'user') ?></div>
		<div class="col-md-6">
			<div class="pull-right">
				<?=pear::goback_button($controller_path) ?>
			</div>
		</div>
	</div>
	<hr>
	<!-- Text input-->
	<div class="form-group">
		<?=pear::field_label('o_user_model','email') ?>
		<div class="col-md-4">
			<?=pear::input('email',$record->email,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>
	<div class="form-group">
		<?=pear::field_label('o_user_model','username') ?>
		<div class="col-md-4">
			<?=pear::input('username',$record->username,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>
	<!-- Password input-->
	<div class="form-group">
		<?=pear::label('Password','password',['class'=>'col-md-3 control-label '.(($form_method != 'post') ? '' : 'required')]) ?>
		<div class="col-md-4">
			<?=pear::password('password','',['class'=>'form-control input-md','autocomplete'=>'off']) ?>
			<?=pear::form_help(config('auth.password copy')) ?>
		</div>
	</div>
	<!-- Password input-->
	<div class="form-group">
		<?=pear::label('Confirm Password','confirm_password',['class'=>'col-md-3 control-label '.(($form_method != 'post') ? '' : 'required')]) ?>
		<div class="col-md-4">
			<?=pear::password('confirm_password','',['class'=>'form-control input-md','autocomplete'=>'off']) ?>
			<?php if ($form_method != 'post') { ?>
				<?=pear::form_help('Leave password fields blank to leave password unchanged.') ?>
			<?php } ?>
		</div>
	</div>
	<?=pear::include('_templates/access') ?>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-3">
			<h4>Save Record Roles <small>(umask)</small></h4>
		</div>
	</div>
	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Read','user_read_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::dropdown('user_read_role_id',$roles_catalog,$record->user_read_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>
	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Edit','user_edit_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::dropdown('user_edit_role_id',$roles_catalog,$record->user_edit_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>
	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Delete','user_delete_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::dropdown('user_delete_role_id',$roles_catalog,$record->user_delete_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-4 col-md-offset-3">
			<h4>Access Role(s)</h4>
		</div>
	</div>
	<!-- Select Multiple -->
	<div class="form-group">
		<?=pear::label('Roles','roles',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::dropdown('roles[]',$roles_catalog,array_keys((array)$record->roles),['class'=>'form-control select3','multiple'=>'multiple']) ?>
		</div>
	</div>
	<!-- Checkbox -->
	<div class="form-group">
		<div class="col-md-offset-3 col-md-4">
			<div class="checkbox">
				<label>
					<?=pear::checkbox('is_active', 1, ($record->is_active == 1),['class'=>'js-checker']) ?> Active
				</label>
			</div>
		</div>
	</div>
	<!-- Submit Button -->
	<div class="form-group">
		<div class="col-md-12">
			<div class="pull-right">
				<?=pear::button(null,'Save',['class'=>'js-button-submit keymaster-s btn btn-primary']) ?>
			</div>
		</div>
	</div>
<?=pear::close() ?>
<?php pear::end() ?>
