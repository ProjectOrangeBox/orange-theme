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

/*
data-widget="url to call"
data-template="javascript template to use"

*/
orange.widget_minipipe = function(that) {
	$.ajax({
		type: 'POST',
		url: $(that).data('widget'),
		async: true,
		data: {
			options: $(that).data()
		},
		success: function(data,textStatus,jqXHR) {
			if (data.html) {
				orange.widget_replace(that,data.html);
			} else if (data.json) {
				var template_id = $(that).data('handlebars');
				
				if (document.getElementById(template_id)) {
					orange.widget_replace(that,Handlebars.compile(document.getElementById(template_id).innerHTML)(data.json));
				} else {
					orange.widget_replace(that,'{{Template ID '+template_id+' Missing}}');
				}
			} else {
				orange.widget_replace(that,'{{HTML Missing}}');
			}
		},
		error: function(jqXHR,textStatus,errorThrown) {
			if ($(that).data().errors == true) {
				orange.widget_replace(that,'{{error}}');
			}
		},
	});
}

orange.widget_replace = function(that,input) {
	if (/^(?:area|br|col|embed|hr|img|input|link|meta|param)$/i.test($(that)[0].tagName)) {
		$(that).replaceWith(input);
	} else {
		$(that).html(input);
	}
}

orange.post = function(url,data,success) {
	$.ajax({type:'POST',url:url,data:data,success:success,dataType:'json'});
}

document.addEventListener("DOMContentLoaded",function(e){
	/* handle ajax widgets */
	$('[data-widget]').each(function() {
		orange.widget_minipipe(this);
	});

	/* make a GET method call */
	$('.js-get').click(function(e) {
		e.preventDefault();

		$.get($(this).attr('href'), function(data) {
			var msg_default = ($(this).data('msg')) ? $(this).data('msg') : 'Complete';
			var type_default = ($(this).data('type')) ? $(this).data('type') : 'info';
			var stay_default = ($(this).data('stay')) ? ($(this).data('stay') == 'true') : false;
			
			var msg = (data.msg) ? data.msg : msg_default;
			var type = (data.type) ? data.type : type_default;
			var stay = (data.stay) ? data.stay : stay_default;

			$.noticeAdd({text: msg, type: type, stay: stay});
		});

	});

	/* setup tooltips */
	$('body').tooltip({
		selector: '.js-tooltip'
	});

	/* handle shift in a tab group */
	$('div.tab-content :checkbox').click(function(event) {
		if (event.shiftKey) {
			$('div.tab-pane.active :checkbox').prop('checked',($(this).prop('checked') || false));
		}
	});

});