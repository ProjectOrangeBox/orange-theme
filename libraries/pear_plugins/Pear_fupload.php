<?php
pear::attach('fupload',function($name,$controller,$class='') {
	ci('page')->js('/theme/orange/assets/plugins/fupload/fupload.js');

	return '<input type="file" id="'.$name.'" class="js-fuploader" data-url="'.$controller.'" style="display:none"><a class="btn '.$class.'" onclick="$(\'#'.$name.'\').click();">Attach</a>';
});

pear::attach('fupload_image',function($name='',$value='',$class='') {
	return '<img src="'.$value.'" id="'.$name.'-preview" class="'.$class.'">';
});

pear::attach('fupload_msg',function($name='',$value='',$class='') {
	return '<span id="'.$name.'-msg" class="'.$class.'">'.basename($value).'</span><input type="hidden" id="'.$name.'-hidden" name="'.$name.'" value="'.$value.'">';
});

pear::attach('fupload_clear',function($name='',$value='',$class='') {
	return '<a id="'.$name.'-remove-btn" data-id="'.$name.'" class="js-fupload-remove btn '.$class.'"'.((empty($value)) ? ' style="display:none"' : '').'>Remove</a>';
});
