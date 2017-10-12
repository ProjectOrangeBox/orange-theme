<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?=$page_title ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<?=$page_meta ?>
	<?=$page_icon?>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<?=$page_css ?>
	<style><?=$page_style ?></style>
	<?=$section_head ?>
</head>
<body class="<?=$page_body_class ?>">
	<?=$section_start?>
	<?=$section_header?>
	<div class="container">
	<?=$section_container?>
	</div>
	<?=$section_footer?>
	<script>
	<?=$page_js_variables?>
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.js"></script>
	<?=$page_js?>
	<script>
	document.addEventListener("DOMContentLoaded",function(e){<?=$page_domready ?>});
	<?=$page_script?>
	</script>
	<?=$section_end?>
</body>
</html>