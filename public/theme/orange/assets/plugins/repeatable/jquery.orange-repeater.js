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

*/
document.addEventListener('DOMContentLoaded',function(e){
	repeatable = {};

	repeatable.update_buttons = function(button) {
		var total = $(repeatable.get(button,'group')).length;
		var add_button = repeatable.get(button,'add');
		var remove_button = repeatable.get(button,'remove');

		if (total >= repeatable.get(button,'max')) {
			$(add_button).attr('disabled','disabled');
		} else {
			$(add_button).removeAttr('disabled');
		}
		
		if (total <= repeatable.get(button,'min')) {
			$(remove_button).attr('disabled','disabled');
		} else {
			$(remove_button).removeAttr('disabled');
		}
	}

	repeatable.get = function(button,attr) {
		return $('#'+$(button).data('template')).data(attr);
	}

	/* init buttons */
	$('.js-repeatable-add').each(function() {
		repeatable.update_buttons(this);
	});

	/* click remove */
	$('form').on('click','.js-repeatable-remove',function(e) {
		$(this).closest(repeatable.get(this,'group')).remove();

		repeatable.update_buttons(this);
	});

	/* click add */
	$('form').on('click','.js-repeatable-add',function(e) {
		$(repeatable.get(this,'append')).append($('#'+$(this).data('template')).html());
		
		repeatable.update_buttons(this);
	});



});