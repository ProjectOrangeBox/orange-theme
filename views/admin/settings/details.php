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

	<div class="form-group">
	  <div class="col-md-offset-3 col-md-4">
		  <h3>Administration View</h3>
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Group','group',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::combobox('group',$record->group,$settings_group_catalog) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Name','name',['class'=>'col-md-3 control-label required']) ?>
		<div class="col-md-4">
			<?=html::input('name',$record->name,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Value','value',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::input('value',$record->value,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Help','help',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::input('help',$record->help,['class'=>'form-control input-md','autocomplete'=>'off']) ?>
		</div>
	</div>

	<!-- Checkbox -->
	<div class="form-group">
		<div class="col-md-offset-3 col-md-4">
			<div class="checkbox">
				<label>
					<?=html::checkbox('enabled', 1, ($record->enabled == 1),['class'=>'js-checker']) ?> Enabled
				</label>
			</div>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=html::label('Read Role','read_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::dropdown('read_role_id',$roles_catalog,$record->read_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=html::label('Edit Role','edit_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::dropdown('edit_role_id',$roles_catalog,$record->edit_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>

	<!-- Select Basic -->
	<div class="form-group">
		<?=html::label('Delete Role','delete_role_id',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::dropdown('delete_role_id',$roles_catalog,$record->delete_role_id,['class'=>'form-control select3']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Internal','internal',['class'=>'col-md-3 control-label']) ?>
		<div class="col-md-4">
			<?=html::input('internal',$record->internal,['readonly'=>'readonly','class'=>'form-control input-md']) ?>
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<?=html::label('Options','options',['class'=>'col-md-3 control-label']) ?>
	  <div class="col-md-7">
			<?=html::textarea(['name'=>'options','value'=>$record->options,'class'=>'form-control','cols'=>66,'rows'=>4]) ?>
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
				<?=html::button(null,'Save',['class'=>'js-button-submit btn btn-primary']) ?>
			</div>
		</div>
	</div>

<?=html::close() ?>

<? page::end() ?>
