<?php pear::asset_merge() ?>

<?php pear::plugins('flash_msg,form_helpers,rest_form') ?>

<?php pear::section('page_js') ?>
<!-- https://cdnjs.com/ -->
<?php pear::parent() ?>
<?php pear::end() ?>

<?php pear::section('page_css') ?>
<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<?php pear::parent() ?>
<?php pear::end() ?>

<?=pear::include('_templates/header') ?>
	<div class="container">
		<?=pear::page('section_container') ?>
	</div>
<?=pear::include('_templates/footer') ?>
