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
