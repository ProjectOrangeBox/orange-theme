<? page::extends('_templates/orange_admin') ?>

<? page::section('section_container') ?>
<form class="form-horizontal" method="<?=$form_method ?>" action="<?=$controller_path ?>" data-success="Record Saved|blue" data-redirect="/admin/dashboard">
	<input type="hidden" name="id" value="<?=$record->id ?>">
	
	<div class="row">
		<div class="col-md-6"><h2>Edit My Profile</h2></div>
	</div>
	<hr>
	
	<!-- Text input-->
	<div class="form-group">
	<label class="col-md-3 control-label required" for="textinput">Email</label>
	<div class="col-md-4">
		<input name="email" type="text" value="<?=$record->email ?>" class="form-control input-md" required="" autocomplete="off">
	</div>
	</div>
		
	<div class="form-group">
	<label class="col-md-3 control-label required" for="textinput">Username</label>
	<div class="col-md-4">
		<input name="username" type="text" value="<?=$record->username ?>" class="form-control input-md" required="" autocomplete="off">
	</div>
	</div>
	
	<!-- Password input-->
	<div class="form-group">
	<label class="col-md-3 control-label required" for="passwordinput">Password</label>
	<div class="col-md-4">
	<input name="password" type="password" class="form-control input-md" required="" autocomplete="off">
  <p class="help-block"><?=config('auth.password copy') ?></p>
	<? if ($form_method != 'post') { ?>
	<p class="help-block">Leave blank to leave password unchanged.</p>
	<? } ?>
	</div>
	</div>

	<!-- Password input-->
	<div class="form-group">
	<label class="col-md-3 control-label required" for="passwordinput">Confirm Password</label>
	<div class="col-md-4">
	<input name="confirm_password" type="password" class="form-control input-md" required="" autocomplete="off">
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

<? page::end() ?>
