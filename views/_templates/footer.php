<?=pear::section('section_footer') ?>
<?=pear::variable('page_js_variables','<script>','</script>') ?>
<?=pear::variable('page_js') ?>
<script>
<?=pear::variable('page_script') ?>
document.addEventListener("DOMContentLoaded",function(e){<?=pear::variable('page_domready') ?>});
</script>
<?=pear::section('section_end') ?>
</body>
</html>
