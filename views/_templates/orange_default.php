<?php pear::plugins('flash_msg,form_tools,rest_form') ?>
<?php pear::section('page_js') ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.js"></script>
<script src="/theme/orange/assets/js/application.js"></script>
<script src="/application/application.js"></script>
<!-- https://cdnjs.com/ -->
<?php pear::parent() ?>
<?php pear::end() ?>
<?php pear::section('page_css') ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="/theme/orange/assets/css/application.css" rel="stylesheet">
<link href="/assets/application/application.css" rel="stylesheet">
<?php pear::parent() ?>
<?php pear::end() ?>
<?=pear::include('_templates/header') ?>
<div class="container">
<?=$section_container ?>
</div>
<?=pear::include('_templates/footer') ?>
