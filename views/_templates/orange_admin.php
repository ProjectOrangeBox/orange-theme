<?php pear::plugins('confirm_dialog,flash_msg,form_helpers,input_mask,keymaster,rest_form,select3,table_sticky_header,tab_save,table_search_field,table_sort,table_remember_position') ?>
<?php pear::section('page_js') ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<script src="/theme/orange/assets/js/application.js"></script>
<!-- https://cdnjs.com/ -->
<?php pear::parent() ?>
<?php pear::end() ?>
<?php pear::section('page_css') ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="/theme/orange/assets/css/application.css" rel="stylesheet">
<?php pear::parent() ?>
<?php pear::end() ?>
<?php pear::include('_templates/header') ?>
<?php pear::include('_templates/nav.php') ?>
<div class="container">
<?=$section_container ?>
</div>
<?php pear::include('_templates/footer') ?>
