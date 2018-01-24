var orange = (orange) || {};
var messages = (messages) || [];
var plugins = (plugins) || [];

/*
hide / show modals
pleaseWaitDiv.modal('show');
pleaseWaitDiv.modal('hide');
*/
var pleaseWaitDiv = $('<div class="modal fade bs-example-modal-sm" id="myPleaseWait" tabindex="-1"role="dialog" aria-hidden="true" data-backdrop="static"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-time"></span> Processing</h4></div><div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only"></span></div></div></div></div></div></div>');

/* get the other tools */
$.getScript('/theme/orange/assets/js/tools.min.js');

function widget_minipipe(that) {
	$.ajax({
		type: 'POST',
		url: $(that).data('widget'),
		async: true,
		data: {
			options: $(that).data()
		},
		success: function(data,textStatus,jqXHR) {
			if (data.html) {
				widget_replace(that,data.html);			
			} else {
				widget_replace(that,'{{HTML Missing}}');			
			}
		},
		error: function(jqXHR,textStatus,errorThrown) {
			if ($(that).data().errors == true) {
				widget_replace(that,'{{error}}');
			}
		},
	});
}

function widget_replace(that,input) {
	if (/^(?:area|br|col|embed|hr|img|input|link|meta|param)$/i.test($(that)[0].tagName)) {
		$(that).replaceWith(input);
	} else {
		$(that).html(input);
	}
}

document.addEventListener("DOMContentLoaded",function(e){
	$('[data-widget]').each(function() {
		widget_minipipe(this);
	});

	$('.js-get').click(function(e) {
		e.preventDefault();
		
		$.get($(this).attr('href'));
		
		$.noticeAdd({text: $(this).data('msg'), type: 'info'});
	});

	$('body').tooltip({
		selector: '.js-tooltip'
	});
});
