<?php pear::extends('_templates/orange_admin') ?>
<?php pear::section('section_container') ?>
<form class="form-horizontal" method="<?=$form_method ?>" action="<?=$controller_path ?>" data-success="Record Saved|blue" data-redirect="/admin/dashboard">
	<input type="hidden" name="id" value="<?=$record->id ?>">
	<div class="row">
		<div class="col-md-6"><h2>Edit My Profile</h2></div>
	</div>
	<hr>
	<!-- Text input-->
	<div class="form-group">
		<?=pear::field_label('o_user_model','email') ?>
		<div class="col-md-4">
			<input name="email" type="text" value="<?=$record->email ?>" class="form-control input-md" required="" autocomplete="off">
		</div>
	</div>
	<div class="form-group">
		<?=pear::field_label('o_user_model','username') ?>
		<div class="col-md-4">
			<input name="username" type="text" value="<?=$record->username ?>" class="form-control input-md" required="" autocomplete="off">
		</div>
	</div>
	<!-- Password input-->
	<div class="form-group">
		<?=pear::label('Password','password',['class'=>'col-md-3 control-label '.(($form_method != 'post') ? '' : 'required')]) ?>
		<div class="col-md-4">
			<?=pear::password('password','',['class'=>'form-control input-md','autocomplete'=>'off']) ?>
			<?=pear::form_help(config('auth.password copy','Password must be at least: 8 characters, 1 upper, 1 lower case letter, 1 number, Less than 32 characters')) ?>
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
	<!-- Button -->
	<div class="form-group">
		<div class="col-md-9">
			<div class="pull-right">
				<button class="js-button-submit keymaster-s btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</form>
<?php pear::end() ?>
