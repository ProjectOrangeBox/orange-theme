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

	<div class="form-group">
	  <div class="col-md-offset-3 col-md-4">
		  <h3>Administration View</h3>
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Group','group',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=pear::combobox('group',$record->group,$settings_group_catalog) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Name','name',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=pear::input('name',$record->name,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Value','value',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::input('value',$record->value,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Help','help',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::input('help',$record->help,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Checkbox -->
	<div class="form-group">
		<div class="col-md-offset-3 col-md-4">
			<div class="checkbox">
				<label>
					<?=pear::checkbox('enabled', 1, ($record->enabled == 1),['class'=>'js-checker']) ?> Enabled
				</label>
			</div>
		</div>
	</div>

	<!-- Start Record Roles -->
	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Read Role','read_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::role_dropdown('read_role_id',$record->read_role_id) ?>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Edit Role','edit_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::role_dropdown('edit_role_id',$record->edit_role_id) ?>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=pear::label('Delete Role','delete_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::role_dropdown('delete_role_id',$record->delete_role_id) ?>
		</div>
	</div>
	<!-- End Record Roles -->

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Internal','internal',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=pear::input('internal',$record->internal,['readonly'=>'readonly','class'=>'form-control input-md']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=pear::label('Options','options',['class'=>'col-md-3 control-label']) ?>
	  <div class="col-md-7">
			<?=pear::textarea(['name'=>'options','value'=>$record->options,'class'=>'form-control','cols'=>66,'rows'=>4]) ?>
			<pre>{"type":"radio","options":{"1":"Red","2":"Green","3":"Yellow","4":"Blue"}}
{"type":"textarea","rows":5}
{"type":"checkbox","value":1,"copy":"Active"}
{"type":"select","options":{"1":"Red","2":"Green","3":"Yellow","4":"Blue"}}
{"type":"text","width":"50","mask":"int"}</pre>
	  </div>
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
