<? pear::extends('_templates/orange_admin') ?>

<? pear::section('section_container') ?>
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
  		<p class="help-block"><?=config('auth.password copy') ?></p>
		</div>
	</div>

	<!-- Password input-->
	<div class="form-group">
		<?=pear::label('Confirm Password','confirm_password',['class'=>'col-md-3 control-label '.(($form_method != 'post') ? '' : 'required')]) ?>
		<div class="col-md-4">
			<?=pear::password('confirm_password','',['class'=>'form-control input-md','autocomplete'=>'off']) ?>
			<? if ($form_method != 'post') { ?>
			<p class="help-block">Leave password fields blank to leave password unchanged.</p>
			<? } ?>
		</div>
	</div>

	<!-- Button -->
	<div class="form-group">
		<div class="col-md-9">
			<div class="pull-right">
				<button class="js-button-submit btn btn-primary">Save</button>
			</div>
		</div>
	</div>
	
</form>

<? pear::end() ?>
