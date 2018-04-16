var plugins = (plugins) || {};

plugins.nestable = {};

plugins.nestable.init = function() {
	plugins.nestable.is_loaded = false;

	var config = {};

	$('.dd').nestable(config);
	$('.dd').nestable('collapseAll');

	/* save on change */
	$('.dd').on('change', function() {
		var serialized = $('.dd').nestable('serialize');

		$.ajax({
			type: "POST",
			url: nestable_handler + '/sort',
			data: {order: serialized},
			success: function(data, textStatus, jqXHR){
				if (data.error == false) {
				} else {
					jQuery.noticeAdd({ text: 'Reorder Save Error', stay: '', type: 'error', stayTime: plugins.flash_msg.pause });
				}
			},
			dataType: 'json'
		});

	});

	/* show record on click */
	$('.dd3-content').on('click',function(e) {
		var id = $(this).closest('li').data('id');
		var background_color = '#e4e4e4';
				
		$('.dd3-content').css('background-color','');
		$("li[data-id='" + id + "'] .btn-default").first().css("background-color",background_color);

		$.ajax({
			type: 'GET',
			url: nestable_handler + '/record/' + id,
			success: function(data, textStatus, jqXHR){
				if (false == false) {
					$('#menu-record').html(data);
				} else {
					jQuery.noticeAdd({ text: 'Record Load Error', stay: '', type: 'error', stayTime: plugins.flash_msg.pause });
				}
			},
			dataType: 'html'
		});

	});

	plugins.nestable.load();

}; /* end */

plugins.nestable.save = function() {
	if (plugins.nestable.is_loaded) {
		var id = '';

		$('.dd li:not(.dd-collapsed)').each(function(index) {
			id = id + $(this).prop('id') + ',';
		});

		$.jStorage.set(nestable_handler, id);
	}
}

plugins.nestable.load = function() {
	var id = $.jStorage.get(nestable_handler,'');

	if (id != '') {
		var res = id.split(',');

		for (i = 0; i < res.length; i++) {
			if (res[i] != '') {
				var li = $('#' + res[i]);

				li.removeClass('dd-collapsed');
				li.children('[data-action="expand"]').hide();
				li.children('[data-action="collapse"]').show();
				li.children('ol').show();
			}
		}
	}

	plugins.nestable.is_loaded = true;
}