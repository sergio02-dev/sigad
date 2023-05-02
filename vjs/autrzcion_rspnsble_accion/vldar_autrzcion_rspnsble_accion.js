/**
 * Karen Yuliana Palacio Minú
 * 01 de Mayo 2023 12:31pm
 * Validar Autorización Responsable Acción
 */
function validar_autorizacion() {
    $('.confirmacion').fadeIn(1);
    $('.confirmacion').focus();
}

function guardar() {
    var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#autorizacionRspnsbleAccionForm').serialize();
   
	document.getElementById('guardar_autorizacion').disabled=true;
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		
		success: function (data) {
			
			$('#frmModal').modal('hide');
            $('#frmModal').modal({backdrop: false});
			$('.modal-backdrop').remove();
			$('#dataAutorizacionResponsableAccion').load("dtaautorizacionresponsableaccion");
		}
	});
	return false;
}

function cancelar() {
    $('.confirmacion').fadeOut(1);
}