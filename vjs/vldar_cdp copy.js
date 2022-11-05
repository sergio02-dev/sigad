function validar_expedicion(){
	var txtFechaExpedicion = $('#txtFechaExpedicion').val();
	var txtNumeroExpedicion = $('#txtNumeroExpedicion').val();
    var descrpcion = $('#descrpcion').val();

	if(txtFechaExpedicion == ''){
        $("#error_fecha_expedicion").fadeIn('300');
        $("#error_fecha_expedicion").html('Seleccione una Fecha');
        document.getElementById("txtFechaExpedicion").focus();
        return false;
    }
    else{
        $("#error_fecha_expedicion").fadeOut('300');
    }

	if(txtNumeroExpedicion == ''){
        $("#error_numero_expedicion").fadeIn('300');
        $("#error_numero_expedicion").html('Ingrese el Número');
        document.getElementById("txtNumeroExpedicion").focus();
        return false;
    }
    else{
        $("#error_numero_expedicion").fadeOut('300');
    }

    $('.validacion').fadeIn(100);
    $('#texto_validacion').html('<span><strong>Esta seguro que desea '+descrpcion+' el CDP # : '+txtNumeroExpedicion+'</strong></span>');

}

$('#aceptar').click(function() {
    var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#cdpform').serialize();
	
    document.getElementById('aceptar').disabled=true;
	$('#carga_guardar').fadeIn(1);

	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		success: function (data) {
			$('#frmModal').modal('hide');
			$('.modal-backdrop').remove();
            if(url_proceso == 'registrocdp'){
                $('#dataCdp').load("dtacdp");
            }
            else{
                $('#dtaCdpExpedido').load("dtacdpexpedido");
            }
			   
		}
	});
});


$('#cancelar').click(function() {
    $('.validacion').fadeOut(100);
    $('#txtNumeroExpedicion').focus();
});