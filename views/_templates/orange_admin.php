<? pear::plugins('search_sort_field,confirm_dialog,flash_msg,form_tools,input_mask,keymaster,rest_form,select3,sticky_table_header,tab_save') ?>

<? pear::section('page_js') ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.js"></script>
<script src="/theme/orange/assets/js/application.js"></script>
<script src="/application/application.js"></script>
<!-- https://cdnjs.com/ -->
<? pear::parent() ?>
<? pear::end() ?>

<? pear::section('page_css') ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="/theme/orange/assets/css/application.css" rel="stylesheet">
<link href="/assets/application/application.css" rel="stylesheet">
<? pear::parent() ?>
<? pear::end() ?>

<? pear::include('_templates/header') ?>
<? pear::include('_templates/nav.php') ?>
<div class="container">
<?=$section_container ?>
</div>
<? pear::include('_templates/footer') ?>
