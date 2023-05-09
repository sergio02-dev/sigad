/**
 * Karen Yuliana Palacio Minú
 * 04 de Mayo 2023 02:55pm
 * Validar Autorización Financiera
 */
function validar_autorizacion() {
    $('.confirmacion').fadeIn(1);
    $('.confirmacion').focus();
}

function guardar() {
    var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#autorizacionOrdenadorGastoForm').serialize();
   
	document.getElementById('guardar_autorizacion').disabled=true;
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		success: function (data) {
			$('#frmModal').modal('hide');
            $('#frmModal').modal({backdrop: false});
			$('.modal-backdrop').remove();
			$('#dataAutorizacionOrdenadorGasto').load("dtaautorizacionordenadorgasto");
		}
	});
	return false;
}

function cancelar() {
    $('.confirmacion').fadeOut(1);
}