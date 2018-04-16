<!-- Start Record Roles -->
<?php if (user::has_role(ADMIN_ROLE_ID)) { ?>
<div class="form-group">
	<div class="col-md-4 col-md-offset-3">
		<h4><span class="toggle-collapse collapsed" data-toggle="collapse" data-target="#record-access">Record Access</span></h4>
	</div>
</div>
<div id="record-access" class="collapse">
	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Read','read_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::role_dropdown('read_role_id',$record->read_role_id) ?>
		</div>
	</div>
	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Edit','edit_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::role_dropdown('edit_role_id',$record->edit_role_id) ?>
		</div>
	</div>
	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Delete','delete_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::role_dropdown('delete_role_id',$record->delete_role_id) ?>
		</div>
	</div>
</div>
<?php } ?>
<!-- End Record Roles -->

<? pear::section('page_style') ?>
.toggle-collapse:after{font-family:'FontAwesome';content:"\f151";float:right}
.toggle-collapse.collapsed:after{content:"\f150"}
<? pear::end() ?>