var orange = (orange) || {};
var messages = (messages) || [];
var plugins = (plugins) || [];

/**
 *
 * example:
 * text field search with debounce
 *
 * table_search_field.field.on('keyup',debounce(function(){
 *   table_search_field.search(table_search_field.get_field());
 * },500));
 *
 */

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};

/**
 *
 * hide / show modals
 * pleaseWaitDiv.modal('show');
 * pleaseWaitDiv.modal('hide');
 *
 */
var pleaseWaitDiv = $('<div class="modal fade bs-example-modal-sm" id="myPleaseWait" tabindex="-1"role="dialog" aria-hidden="true" data-backdrop="static"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-time"></span> Processing</h4></div><div class="modal-body"><div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only"></span></div></div></div></div></div></div>');

/**
 *
 * data-widget="url to call"
 * data-template="javascript template to use"
 *
 * if you use a js template remember you need to remember to include the handlebars library
 *
 * <script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
 *
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

/**
 *
 * Javascript / JQuery to replace if it's a single element tag or "insert" if it's a pair
 *
 */
orange.widget_replace = function(that,input) {
	if (/^(?:area|br|col|embed|hr|img|input|link|meta|param)$/i.test($(that)[0].tagName)) {
		$(that).replaceWith(input);
	} else {
		$(that).html(input);
	}
}

/**
 *
 * Javascript / JQuery Wrappers to POST, PATCH, and PUT
 *
 */
orange.post = function(url,data,success) {
	$.ajax({type:'POST',url:url,data:data,success:success,dataType:'json'});
}
orange.patch = function(url,data,success) {
	$.ajax({type:'PATCH',url:url,data:data,success:success,dataType:'json'});
}
orange.put = function(url,data,success) {
	$.ajax({type:'PUT',url:url,data:data,success:success,dataType:'json'});
}
orange.get = function(url,data,success) {
	$.ajax({type:'GET',url:url,data:data,success:success,dataType:'json'});
}

orange.notice_off_element = function(element,options) {
	var data = element.data();

	$.extend(data,options);

	if (data.msg) {
		var type = (data.type) ? data.type : 'info';
		var stay = (data.stay) ? (data.stay == 'true') : false;

		$.noticeAdd({text: data.msg, type: type, stay: stay});
	}
}

document.addEventListener("DOMContentLoaded",function(e){
	/**
	 *
	 * handle ajax widgets
	 *
	 */
	$('[data-widget]').each(function() {
		orange.widget_minipipe(this);
	});

	/**
	 *
	 * Make a GET method call
	 *
	 */
	$('.js-get').click(function(e) {
		e.preventDefault();

		/* save this for the success function */
		orange.js_get_that = $(this);

		orange.get($(this).attr('href'),$(this).data(),function(data) {
			/* call this on success */
			orange.notice_off_element(orange.js_get_that,data);
		});
	});

	$('.hide-until-domready').show();
});

function orangejax(method,url,data,handlers) {
	var statusCodeDefaults = {
		200: function(data, textStatus, jqXHR) { notify.addSuccess('200 OK') }, /* 200 OK */
		201: function(data, textStatus, jqXHR) { notify.addSuccess('201 Created') }, /* 201 Created after insert/post */
		202: function(data, textStatus, jqXHR) { notify.addSuccess('202 Accepted') }, /* 202 Accepted after update/patch */

		401: function(jqXHR, textStatus, errorThrown) { notify.addError('401 Unauthorized') }, /* 401 Unauthorized - no access to resource */

		404: function(jqXHR, textStatus, errorThrown) { notify.addError('404 Not Found') }, /* 404 Not Found - resource not found update/patch read/get */
		406: function(jqXHR, textStatus, errorThrown) { notify.addError('406 Not Acceptable') }, /* 406 Not Acceptable - input error on update/patch insert/post delete/delete */

		500: function(jqXHR, textStatus, errorThrown) { notify.addError('500 Internal Server Error') }, /* 500 Internal Server Error */
	};

	jQuery.ajax({
		method: method,
		url: url,
		data: data,
		dataType: 'json',
		cache: false,
		timeout: 5000, /* 5 seconds */
		async: true,
		statusCode: Object.assign(statusCodeDefaults,handlers),
	});
}
