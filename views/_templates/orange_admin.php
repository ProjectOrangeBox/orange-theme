<?php pear::asset_merge() ?>

<?php pear::plugins('confirm_dialog,flash_msg,form_helpers,input_mask,keymaster,rest_form,select3,table_sticky_header,tab_save,table_sort,table_remember_position,notify,bootbox') ?>

<?php pear::section('page_js') ?>
<!-- https://cdnjs.com/ -->
<?php pear::parent() ?>
<?php pear::end() ?>

<?php pear::section('page_css') ?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<?php pear::parent() ?>
<?php pear::end() ?>

<?php pear::include('_templates/header') ?>
<?php pear::include('_templates/nav.php') ?>
	<div class="container">
		<?=pear::page('section_container') ?>
	</div>
<?php pear::include('_templates/footer') ?>
