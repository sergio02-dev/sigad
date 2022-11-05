function validar_solicitud_cdp(){
	var selAccion = $('#selAccion').val();
    var chkestado = $('input:radio[name=chkestado]:checked').val();
	var txtFechaSolicitud = $('#txtFechaSolicitud').val();
	var txtNumeroSolicitud = $('#txtNumeroSolicitud').val();

	if(txtFechaSolicitud == '0'){
        $("#error_fecha_solicitud").fadeIn('300');
        $("#error_fecha_solicitud").html('Seleccione una Fecha');
        document.getElementById("txtFechaSolicitud").focus();
        return false;
    }
    else{
        $("#error_fecha_solicitud").fadeOut('300');
    }

	if(txtNumeroSolicitud == ''){
        $("#error_numero_solicitud").fadeIn('300');
        $("#error_numero_solicitud").html('Ingrese el Número de Solicitud');
        document.getElementById("txtNumeroSolicitud").focus();
        return false;
    }
    else{
        $("#error_numero_solicitud").fadeOut('300');
    }

	if(selAccion == 0){
        $("#error_accion").fadeIn('300');
        $("#error_accion").html('Seleccione una Opcion');
        document.getElementById("selAccion").focus();
        return false;
    }
    else{
        $("#error_accion").fadeOut('300');
    }	

	if(!chkestado){
        $("#error_estado").fadeIn('300');
        $("#error_estado").html('Seleccione una Opcion');
        document.getElementById("ractivo").focus();
        return false;
    }
    else{
        $("#error_estado").fadeOut('300');
    }

	//Inicio Validacion Etapas
	cod_etapas = $('[name="etpass[]"]:checked').map(function () {
						return this.value;
					}).get();

	cantidad_etapas = cod_etapas.length;

	if(cantidad_etapas == 0){
		$('#error_etapas').html('Seleccione al menos una Etapa');
		return false;
	}
	else{
		$('#error_etapas').html('');
	}
	
	for (let index = 0; index < cod_etapas.length; index++) {
		var valetapa = $('#valetapa'+cod_etapas[index]).val();
		var control_valor = $('#control_valor'+cod_etapas[index]).val();
		var other_valor = $('#valor'+cod_etapas[index]).val();
		var sumatoria_etapa = $('#sumatoria_etapa'+cod_etapas[index]).val();
		var cantidad_asignacion = $('#cantidad_asignaciones'+cod_etapas[index]).val();
		var suma_validacion = $('#suma_validacion'+cod_etapas[index]).val();

		other_valor = other_valor.toString().replace(/\./g,'');

		var valor_validar = 0;

		if(control_valor == 1){
			if(parseFloat(valetapa) < parseFloat(other_valor)){
				$('#error_valor_etpa'+cod_etapas[index]).html('No puede ser mayor al valor de la Etapa');
				return false;
			}
			else{
				$('#error_valor_etpa'+cod_etapas[index]).html('');
			}
			valor_validar = other_valor;
		}
		else{
			control_valor = 0;
			valor_validar = valetapa;
		}

		var num_clasificadores = 0;
		$("input[name='codigo_clasificador"+cod_etapas[index]+"[]']").each(function(indice, elemento) {
			var clasificador_etapa = $(elemento).val();

			if(clasificador_etapa == ''){
				num_clasificadores++;
			}
		});

		if(num_clasificadores > 0){
			$("#errro_clasificador"+cod_etapas[index]).fadeIn('300');
			$('#errro_clasificador'+cod_etapas[index]).html('Debe Ingresar los clasificadores');
			return false;
		}
		else{
			$("#errro_clasificador"+cod_etapas[index]).fadeOut('300');
			$('#errro_clasificador'+cod_etapas[index]).html('');
		}

		if(cantidad_asignacion > 0){
			$("input[name='codigo_recurso"+cod_etapas[index]+"[]']").each(function(indice, elemento) {
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
				$("#error_solicitado_etapa"+cod_etapas[index]).fadeOut('300');
				$('#error_solicitado_etapa'+cod_etapas[index]).html('');
			}
			else{
				$("#error_solicitado_etapa"+cod_etapas[index]).fadeIn('300');
				$('#error_solicitado_etapa'+cod_etapas[index]).html('EL Valor Solicitado no coincide con el valor asignado');
				return false;
			}
			
		}
		else{
			$("#recurso_slctado"+cod_etapas[index]).fadeIn('300');
			$('#recurso_slctado'+cod_etapas[index]).html('No hay recursos Asignados para la Etapa');
			return false;
		}

	}

	//Fin Validacion Etapas y valores

	var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#solicitudcdpform').serialize();
	
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		success: function (data) {
			$('#frmModal').modal('hide');
			$('.modal-backdrop').remove();
			$('#dataSolicitud').load("dtasolicitudcdp");   
		}
	});
	return false;
}