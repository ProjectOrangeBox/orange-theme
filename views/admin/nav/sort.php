<?php pear::extends('_templates/orange_admin') ?>

<?php pear::section('section_container') ?>

<div class="row">
	<div class="col-md-6"><h3><i class="fa fa-bars"></i> Navigation</h3></div>
	<div class="col-md-6">
		<div class="pull-right">
				<?=pear::goback_button($controller_path) ?>
		</div>
	</div>
</div>

<div class="row hide-until-domready">
	<div class="col-md-6 col-md-offset-3">
		<div class="dd">
			<?=$list ?>
		</div>
	</div>
</div>

<?php pear::end() ?>

<?php pear::section('page_js') ?>
<?php pear::parent() ?>
<script src="/theme/orange/assets/plugins/nestable/jquery.nestable.min.js"></script>
<?php pear::end() ?>

<?php pear::section('page_domready') ?>
<?php pear::parent() ?>
	$('.dd').nestable({}).nestable('collapseAll').on('change',function(){
		$.ajax({type:"POST",url:controller_path,data:{"tree":$(this).nestable('serialize')},success:function(data){$.noticeAdd({text:data.html,type:'info',stay:false});}});
	});
<?php pear::end() ?>

<?php pear::section('page_css') ?>
<?php pear::parent() ?>
<link href="/theme/orange/assets/plugins/nestable/nestable.min.css" rel="stylesheet">
<?php pear::end() ?>
