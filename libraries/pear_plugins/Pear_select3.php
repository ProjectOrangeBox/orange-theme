<?php
ci('page')
	->js('//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js')
	->css('//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css')
	->domready("$('.select3').selectpicker();");
