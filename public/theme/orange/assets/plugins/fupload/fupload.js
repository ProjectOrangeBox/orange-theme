/*
This works with the fileUploaderHandlerController
*/
var fuploader = {};

fuploader.client = new XMLHttpRequest();

$(function() {
	$('.js-fuploader').on('change',function() {
		fuploader.upload(this);
	});
	
	$('.js-fupload-remove').on('click',function() {
		fuploader.clear(this);
	});
	
});

fuploader.clear = function(that) {
	var id = $(that).data('id');
	
	$('#' + id + '-msg').html('');
	$('#' + id + '-hidden').val('');
	$('#' + id + '-new').val('');
	$('#' + id + '-preview').prop('src','');
}

fuploader.upload = function(that) {
	/* current one we are working on */
	fuploader.id = $(that).prop('id');
	
	var url = $('#'+fuploader.id).data('url');
	var file = document.getElementById(fuploader.id);

	/* is the preview box there? */
	if ($('#' + fuploader.id + '-preview').length) {
		fuploader.readURL(that);
	}

	/* show the progress */
	pleaseWaitDiv.modal('show');

	/* Create a FormData instance */
	var formData = new FormData();

	/* Add the file */
	formData.append('url', url);
	
	/* in PHP $_FILES */
	formData.append(fuploader.id, file.files[0]);

	var form_obj = fuploader.objectifyForm($(that).closest('form').serializeArray());

	for (var prop in form_obj) {
		if (form_obj.hasOwnProperty(prop)) {
			formData.append(prop,form_obj[prop]);
		}
	}

	fuploader.client.open('post', url, true);

	fuploader.client.send(formData);  /* Send to server */
}

/* convert serializeArray to simple array */
fuploader.objectifyForm = function(formArray) {
	var returnArray = {};
	
	for (var i = 0; i < formArray.length; i++){
		returnArray[formArray[i]['name']] = formArray[i]['value'];
	}
	
	return returnArray;
}

/* Check the response status */
fuploader.client.onreadystatechange = function() {
	/*
	readyState	Holds the status of the XMLHttpRequest. Changes from 0 to 4:
	0: request not initialized
	1: server connection established
	2: request received
	3: processing request
	4: request finished and response is ready
	status	200: "OK"
	404: Page not found
	*/

	if (fuploader.client.readyState == 4 && fuploader.client.status == 200) {
		pleaseWaitDiv.modal('hide');

		/* remove any notices on the screen */
		$.noticeRemoveAll();

		/* the responds back from server */
		var response = JSON.parse(fuploader.client.response);

		if (response.error == false) {
			$('#' + response.fieldname + '-msg').html(response.filename);
			
			if ($('#' + response.fieldname + '-new').length) {
				$('#' + response.fieldname + '-new').val(response.attached_id);
			} else {
				$('#' + response.fieldname).after('<input type="hidden" name="' + response.fieldname + '-new" id="" value="' + response.attached_id + '">');
			}

			/* success msg */
			var msg = (response.msg) ? response.msg : 'Attached';
			
			$.noticeAdd({text:msg,type:'info'});
		} else {
			/* remove the image if it exists */
			$('#' + fuploader.id + '-preview').attr('src','');

			/* clear filename if any */
			$('#' + response.fieldname + '-msg').html('');

			/* popup a flash msg if one is provided */
			var msg = (response.msg) ? response.msg : 'Attach Error';
			
			$.noticeAdd({text:msg,type:'danger',stay:true,stayTime:0});
		}
	}
}

fuploader.readURL = function(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#' + fuploader.id + '-preview').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}