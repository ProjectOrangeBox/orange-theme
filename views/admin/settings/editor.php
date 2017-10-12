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

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="textinput">Group</label>  
		<div class="col-md-6">
			<p class="form-control-static required"><?=$record->group ?></p>
		</div>
	</div>
		
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="textinput">Name</label>  
		<div class="col-md-6">
      <p class="form-control-static required"><?=$record->name ?></p>
		</div>
	</div>
		
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-3 control-label" for="textinput">Value</label>  
	  <div class="col-md-6">
	<? 
/*
{"type":"radio","options":{"1":"Red","2":"Green","3":"Yellow","4":"Blue"}}
{"type":"textarea","rows":5}
{"type":"checkbox","value":1,"copy":"Active"}
{"type":"select","options":{"1":"Red","2":"Green","3":"Yellow","4":"Blue"}}
{"type":"text","width":"50","mask":"int"}
*/
	switch($options->type) {
		case 'radio':
			foreach ($options->options as $value=>$copy) {
				echo '<div class="radio">';
				echo '<label>';
				echo '<input type="radio" name="value" '.(($record->value == $value) ? 'checked' : '').' value="'.$value.'">'.$copy;
				echo '</label>';
				echo '</div>';
			}
		break;
		case 'textarea':
			echo '<textarea name="value" class="form-control" rows="'.$options->rows.'">'.$record->value.'</textarea>';
		break;
		case 'checkbox':
			echo '<div class="checkbox">';
			echo '<label>';
			echo '<input type="checkbox" class="js-checker" name="value" '.(($record->value) ? 'checked' : '').' value="'.$options->value.'"> '.$options->copy;
			echo '</label>';
			echo '</div>';
		break;
		case 'select':
	    	echo '<select name="value" class="form-control select3">';
				foreach ($options->options as $value=>$copy) {
					echo '<option value="'.$value.'" '.(($record->value == $value) ? 'selected' : '').'>'.$copy.'</option>';
				}			
	    	echo '</select>';
		break;
		case 'text':
		 echo '<input name="value" type="text" data-mask="'.$options->mask.'" value="'.$record->value.'" class="form-control" style="width:'.$options->width.'%" autocomplete="off">';
		break;
		default:
		 echo '<input name="value" type="text" value="'.$record->value.'" class="form-control input-md" autocomplete="off">';
	}
	?>
	    <p class="help-block"><?=$record->help ?></p>
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
