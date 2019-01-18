/**
 * 
 * WYSIWYG editor
 * 
 * used in conjunction with pear::summernote($name,$value,$extras)
 * 
 * extras are just attributes added to the textarea
 *
 * https://cdnjs.com/libraries/summernote
 * https://cdnjs.com/libraries/codemirror
 *
 */
summernote_init = function(that) {
	
	var id = $(that).attr('id');
	var height = $(that).height();
	var toolbar_idx = ($(that).data('toolbar')) || 0;
	var toolbars = [];
		
	/* default */
	toolbars[0] = [['style', ['bold', 'italic', 'underline', 'clear']],['font', ['strikethrough', 'superscript', 'subscript']],['fontsize', ['fontsize']],['color', ['color']],['para', ['ul', 'ol', 'paragraph']],['height', ['height']]];
	toolbars[1] = [['style', ['bold', 'italic', 'underline', 'clear']]];

	$('#'+id).summernote({
			toolbar: toolbars[toolbar_idx],
			height: height,
			codemirror: {
				lineNumbers: true,
				theme: 'eclipse',
				indentUnit: 2,
				tabSize: 2
			}
	});
}

document.addEventListener("DOMContentLoaded",function(e){
	$('.summernote').each(function(){ summernote_init(this); });
});