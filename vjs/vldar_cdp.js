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

    $("input[name='etapass[]']").each(function(indice, elemento) {
        var codigo_etapa = $(elemento).val();
        var control_valor = $('#control_valor'+codigo_etapa).val();
        var valetapa = $('#valetapa'+codigo_etapa).val();
        var other_valor = $('#valor'+codigo_etapa).val();
        var suma_validacion = $('#suma_validacion'+codigo_etapa).val();
        var cantidad_asignacion = $('#cantidad_asignaciones'+codigo_etapa).val();


        other_valor = other_valor.toString().replace(/\./g,'');

		var valor_validar = 0;

		if(control_valor == 1){
			if(parseFloat(valetapa) <parseFloat(other_valor)){
				$('#error_valor_etpa'+codigo_etapa).html('No puede ser mayor al valor de la Etapa');
				return false;
			}
			else{
				$('#error_valor_etpa'+codigo_etapa).html('');
			}
			valor_validar = other_valor;
		}
		else{
			control_valor = 0;
			valor_validar = valetapa;
		}

        var num_clasificadores = 0;
		$("input[name='codigo_clasificador"+codigo_etapa+"[]']").each(function(indice, elemento) {
			var clasificador_etapa = $(elemento).val();

			if(clasificador_etapa == ''){
				num_clasificadores++;
			}
		});
		
		if(num_clasificadores > 0){
			$("#errro_clasificador"+codigo_etapa).fadeIn('300');
			$('#errro_clasificador'+codigo_etapa).html('Debe Ingresar los clasificadores');
			return false;
		}
		else{
			$("#errro_clasificador"+codigo_etapa).fadeOut('300');
			$('#errro_clasificador'+codigo_etapa).html('');
		}

        if(cantidad_asignacion > 0){
			$("input[name='codigo_recurso"+codigo_etapa+"[]']").each(function(indice, elemento) {
				var codigo_asignacion = $(elemento).val();
				var recurso_asignado = $('#recurso_asignado'+codigo_asignacion).val();
				var fuente_cambio = $('#fuentes_asgnacion'+codigo_asignacion).val();
				var cambio_valor = $('input:checkbox[name=checkCmbioval'+codigo_asignacion+']:checked').val();

				fuente_cambio = fuente_cambio.toString().replace(/\./g,'');

				if(!cambio_valor){

				}
				else{
					if(fuente_cambio == ''){
						$("#error_vacio_asignado"+codigo_asignacion).fadeIn('300');
						$('#error_vacio_asignado'+codigo_asignacion).html('El campo no puede ir vacío');
						return false;
					}
					else{
						$("#error_vacio_asignado"+codigo_asignacion).fadeOut('300');
						$('#error_vacio_asignado'+codigo_asignacion).html('');

						if(parseFloat(recurso_asignado) < parseFloat(fuente_cambio)){
							$("#error_valor_asignado"+codigo_asignacion).fadeIn('300');
							$('#error_valor_asignado'+codigo_asignacion).html('El valor no puede ser mayor al disponible');
							return false;
						}
						else{
							$("#error_valor_asignado"+codigo_asignacion).fadeOut('300');
							$('#error_valor_asignado'+codigo_asignacion).html('');							
						}
					}

					
				}

			});

			
			if(parseFloat(valor_validar) == parseFloat(suma_validacion)){
				$("#error_solicitado_etapa"+codigo_etapa).fadeOut('300');
				$('#error_solicitado_etapa'+codigo_etapa).html('');
			}
			else{
				$("#error_solicitado_etapa"+codigo_etapa).fadeIn('300');
				$('#error_solicitado_etapa'+codigo_etapa).html('EL Valor Solicitado no coincide con el valor asignado');
				return false;
			}
			
		}
		else{
			$("#recurso_slctado"+codigo_etapa).fadeIn('300');
			$('#recurso_slctado'+codigo_etapa).html('No hay recursos Asignados para la Etapa');
			return false;
		}
       

    });

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