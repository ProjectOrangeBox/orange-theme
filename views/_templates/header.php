<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?=pear::variable('page_title') ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<?=pear::variable('page_meta') ?>
	<?=pear::variable('page_css') ?>
	<?=pear::variable('page_style','<style>','</style>') ?>
	<?=pear::variable('page_icon') ?>
	<?=pear::section('section_head') ?>
</head>
<body class="<?=pear::variable('page_body_class') ?>">
