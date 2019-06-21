/**
 * Add a notice
 * notify.add('text',"[success|danger|warning|info]",(optional redirect)'/foo/bar);
 *
 * Remove all of the notices on the screen
 * notify.removeAll();
 *
 * Raw add msg
 * notify.show({text:'text message',style:"[success|danger|warning|info]",stay: [true|false]});
 *
 */

var notify = {
	addInfo: function(text,redirect) {
		this.add(text,'info',redirect);
	},
	addSuccess: function(text,redirect) {
		this.add(text,'success',redirect);
	},
	addError: function(text,redirect) {
		this.add(text,'danger',redirect);
	},
	add: function(text,style,redirect) {
		var msg = this.buildMsg(text,style);

		if (msg) {
			if (redirect == undefined) {
				this.show(msg);
			} else {
				this.save(msg);

				/* special @ redirects? we only have 1 right now */
				switch(redirect) {
					case '@back':
						window.history.back();
					break;
					default:
						window.location.href = redirect;
				}
			}
		}
	},
	removeAll: function() {
		jQuery('.notice-item-wrapper').each(function(){
			$(this).remove();
		});
	},
	show: function(msg) {
		var self = this;
		var noticeWrapAll, noticeItemOuter, noticeItemInner, noticeItemClose;

		noticeWrapAll	= (!jQuery('.notice-wrap').length) ? jQuery('<div></div>').addClass('notice-wrap').appendTo('body') : jQuery('.notice-wrap');
		noticeItemOuter	= jQuery('<div></div>').addClass('notice-item-wrapper');
		noticeItemInner	= jQuery('<div></div>').hide().addClass('notice-item alert alert-' + msg.style).attr('data-dismiss','alert').appendTo(noticeWrapAll).html(msg.text).animate({opacity: 'show'}, 600).wrap(noticeItemOuter);
		noticeItemClose	= jQuery('<div></div>').addClass('close').prependTo(noticeItemInner).html('&times;').click(function(e) {
			e.stopPropagation();
			self._remove(noticeItemInner)
		});

		if (!msg.stay) {
			/* if they didn't include anything then use 4 seconds */
			msg.stayTime = (msg.stayTime != undefined) ? msg.stayTime : this.stayTime;

			/* if they didn't use milliseconds adjust it */
			msg.stayTime = (msg.stayTime > 30) ? msg.stayTime : msg.stayTime * 1000;

			setTimeout(function() {
				self._remove(noticeItemInner);
			}, msg.stayTime);
		}
	},
	save: function(msg) {
		var message = $.jStorage.get('notify_flash_msg',[]);

		message.push(msg);

		$.jStorage.set('notify_flash_msg',message);
	},
	init: function() {
		var self = this;
		if (typeof messages !== 'undefined') {
			/* if they didn't include anything then use 4 seconds */
			this.stayTime = (messages.pause != undefined) ? messages.pause : 3000;

			/* if they didn't use milliseconds adjust it */
			this.stayTime = (this.stayTime > 30) ? this.stayTime : this.stayTime * 1000;
		} else {
			this.stayTime = 3000;
		}

		/* Any message in cold storage? */
		var saved_messages = this._load();

		if (saved_messages) {
			saved_messages.forEach(function(message) {
				self.add(message.text,message.style);
			});
		}

		/**
		 * Any messages attached to the
		 * javascript global variable message on the page?
		 * this is inserted into the page from the server code
		 *
		 * <script>var $messages = "[{text:'Foo',style:'success'},{text:'Bar',style:'danager'}]";</script>
		 */
		if (typeof messages !== 'undefined') {
			messages.forEach(function(message) {
				self.add(message.msg,message.type);
			});
		}
	},
	buildMsg: function(text,style) {
		var msg = undefined;
		var map = {
			red: 'danger',
			yellow: 'warning',
			blue: 'info',
			green: 'success',
			danger: 'danger',
			warning: 'warning',
			info: 'info',
			success: 'info',
			error: 'danager',
			failure: 'danager'
		};

		if (text && style) {
			msg = {};

			msg.text = (text != undefined) ? text : 'No Message Given.';
			msg.style = (style != undefined) ? map[style] : 'info';
			msg.stay = (msg.style == 'danger');
		}

		return msg;
	},
	_load: function(msg) {
		var messages = $.jStorage.get('notify_flash_msg',false);

		$.jStorage.deleteKey('notify_flash_msg');

		return messages;
	},
	_remove: function(obj) {
		obj.animate({opacity: '0'}, 600, function() {
			obj.parent().animate({height: '0px'}, 300, function() {
				obj.parent().remove();
			});
		});
	}
};

notify.init();
