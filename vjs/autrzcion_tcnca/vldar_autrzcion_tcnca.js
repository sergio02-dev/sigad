/**
 * Karen Yuliana Palacio Minú
 * 26 de Abril 2023 03:11pm
 * Validar Autorización Tecnica
 */
function validar_autorizacion() {
    $('.confirmacion').fadeIn(1);
    $('.confirmacion').focus();
}

function guardar() {
    var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#autorizacionTecnicaForm').serialize();
    //alert(url_proceso);
	document.getElementById('guardar_autorizacion').disabled=true;
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		
		success: function (data) {
			
			$('#frmModal').modal('hide');
            $('#frmModal').modal({backdrop: false});
			$('.modal-backdrop').remove();
			$('#dataAutorizacionTecnica').load("dtaautorizaciontecnicasolicitud");
		}
	});
	return false;
}

function cancelar() {
    $('.confirmacion').fadeOut(1);
}