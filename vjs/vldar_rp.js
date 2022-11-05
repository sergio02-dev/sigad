function numberWithCommas(formatoNumero) {
    return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function validarRp(){
	var txtFecha = $('#txtFecha').val();
	var txtCodigoRp = $('#txtCodigoRp').val();
    var val_other = $('input:checkbox[name=checkOtrval]:checked').val();
    var valor = $('#valor').val();
    var txtValor = $('#txtValor').val();
    var descripcion = $('#descripcion').val();
    var txtProveedor = $('#txtProveedor').val();
    var txtActoAdm = $('#txtActoAdm').val();
    var txtServicio = $('#txtServicio').val();
    var valor_mostrar = 0;

    valor = valor.toString().replace(/\./g,'');

	if(txtFecha == ''){
        $("#error_fecha_expedicion").fadeIn('300');
        $("#error_fecha_expedicion").html('Seleccione una Fecha');
        document.getElementById("txtFecha").focus();
        return false;
    }
    else{
        $("#error_fecha_expedicion").fadeOut('300');
        $("#error_fecha_expedicion").html('');
    }

	if(txtCodigoRp == ''){
        $("#error_numero_expedicion").fadeIn('300');
        $("#error_numero_expedicion").html('Ingrese el Número');
        document.getElementById("txtCodigoRp").focus();
        return false;
    }
    else{
        $("#error_numero_expedicion").fadeOut('300');
        $("#error_numero_expedicion").html('');
    }

    if(txtProveedor == ''){
        $("#error_proveedor").fadeIn('300');
        $("#error_proveedor").html('Ingrese el Proveedor');
        document.getElementById("txtProveedor").focus();
        return false;
    }
    else{
        $("#error_proveedor").fadeOut('300');
        $("#error_proveedor").html('');
    }

    if(txtActoAdm == ''){
        $("#error_acto_admi").fadeIn('300');
        $("#error_acto_admi").html('Ingrese el Acto Administrativo');
        document.getElementById("txtActoAdm").focus();
        return false;
    }
    else{
        $("#error_acto_admi").fadeOut('300');
        $("#error_acto_admi").html('');
    }

    if(txtServicio == ''){
        $("#error_servicio").fadeIn('300');
        $("#error_servicio").html('Ingrese la Descripción del Servicio');
        document.getElementById("txtServicio").focus();
        return false;
    }
    else{
        $("#error_servicio").fadeOut('300');
        $("#error_servicio").html('');
    }

    if(val_other == 1){
        if(valor == ''){
            $("#error_valor").fadeIn('300');
            $("#error_valor").html('Ingrese el Valor');
            document.getElementById("valor").focus();
            return false;
        }
        else{
            $("#error_valor").fadeOut('300');
            $("#error_valor").html('');
        }

        if(parseFloat(valor) > parseFloat(txtValor)){
            $("#error_valor").fadeIn('300');
            $("#error_valor").html('No puede ser mayor al Valor Expedido en el CDP');
            document.getElementById("valor").focus();
            return false;
        }
        else{
            $("#error_valor").fadeOut('300');
            $("#error_valor").html('');
        }
        valor_mostrar = valor;
    }
    else{
        $("#error_valor").fadeOut('300');
        $("#error_valor").html('');
        valor_mostrar = txtValor;
    }

    $('.validacion').fadeIn(100);
    $('#texto_validacion').html('<span><strong>Esta seguro que desea '+descripcion+' el RP # : '+txtCodigoRp+' por el valor de $ '+numberWithCommas(valor_mostrar)+'</strong></span>');

}

$('#aceptar').click(function() {
    var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#rpform').serialize();
	
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		success: function (data) {
			$('#frmModal').modal('hide');
			$('.modal-backdrop').remove();
			$('#dataRp').load("dtarp");   
		}
	});
});


$('#cancelar').click(function() {
    $('.validacion').fadeOut(100);
    $('#txtCodigoRp').focus();
});