<?php
/*
add button
		<button type="button" data-template="repeatable-template" class="repeatable-add-button js-repeatable-add btn btn-primary">Add +</button>
		<?=pear::repeatable_add_button('repeatable-add-button','repeatable-template') ?>
remove button
		<button type="button" data-template="repeatable-template" class="repeatable-remove-button js-repeatable-remove btn btn-danger">Remove -</button>
		<?=pear::repeatable_remove_button('repeatable-remove-button','repeatable-template') ?>

	<?=pear::repeatable_start_template('repeatable-template','.repeatable-add-button','.repeatable-remove-button','.repeatable-group',8,1,'#repeatable-append') ?>
		<?=pear::include('test/repeatable',['parent_id'=>$id]) ?>
	<?=pear::repeatable_end_template('repeatable-append') ?>

<!-- Text input-->
<input type="hidden" name="repeatable|id[]" value="<?=$id ?>">
<input type="hidden" name="repeatable|parent_id[]" value="<?=$parent_id ?>">

<fieldset class="repeatable-group">
	<div class="form-group">
		<label class="col-md-3 control-label" for="textinput">First Name</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="repeatable|firstname][]" value="<?=$firstname ?>">
		</div>
	</div>

	<!-- Text input-->
	<div class="form-group">
		<label class="col-md-3 control-label" for="textinput">Last Name</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="repeatable|lastname][]" value="<?=$lastname ?>">
		</div>
	</div>

	<div class="form-group text-right">
		<div class="col-md-12">
			<?=pear::repeatable_remove_button('repeatable-remove-button','repeatable-template') ?>
		</div>
	</div>
</fieldset>

		ci('input')->request_remap([],[],[],'root',null,'|',true,true);

		var_dump(ci('input')->request());

*/
class pear_repeatable_start_template extends Pear_plugin {

	public function __construct() {
		ci('page')->js('/theme/orange/assets/plugins/repeatable/jquery.orange-repeater'.PAGE_MIN.'.js');
	}

	public function render($id=nill,$add_button_class=null,$remove_button_class=null,$group_class=null,$max=null,$min=null,$append_id=null) {
		return '<script id="'.$id.'" type="text/x-handlebars-template" data-add="'.$add_button_class.'" data-remove="'.$remove_button_class.'" data-group="'.$group_class.'" data-max="'.$max.'" data-min="'.$min.'" data-append="'.$append_id.'">';
	}

}