function validar_solicitud_cdp(){
	var selAccion = $('#selAccion').val();
	var txtObjetoCDP = $('#txtObjetoCDP').val();
    var chkestado = $('input:radio[name=chkestado]:checked').val();
	var txtFechaSolicitud = $('#txtFechaSolicitud').val();
	var txtNumeroSolicitud = $('#txtNumeroSolicitud').val();
	var cod_actividades = new Array();



	//validacion objeto
	if(txtObjetoCDP == ''){
        $("#error_objeto_solicitud").fadeIn('300');
        $("#error_objeto_solicitud").html('Ingrese el objeto de Solicitud');
        document.getElementById("txtObjetoCDP").focus();
        return false;
    }
	else if (txtObjetoCDP.length < 10){
		$("#error_objeto_solicitud").fadeIn('300');
		$("#error_objeto_solicitud").html('Ingrese minimo diez caracteres');
		document.getElementById("txtObjetoCDP").focus();
        return false;
	}
	else{
        $("#error_objeto_solicitud").fadeOut('300');
    }
	
	//-------------------------------
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

	//Inicio Validación actividades
	cod_actividades = $('[name="actvddes[]"]:checked').map(function () {
							return this.value;
						}).get();

	cantidad_actividades = cod_actividades.length;

	if(cantidad_actividades == 0){
		$('#error_actividades').html('Seleccione al menos una Actividad');
		return false;
	}
	else{
		$('#error_actividades').html('');
	}

	//Inicio Validación Etapas
	for (let countActivis = 0; countActivis < cod_actividades.length; countActivis++) {
		var codigo_etapa = $('#etpass'+cod_actividades[countActivis]).val();
		var array_clasificadores = new Array();

		if(codigo_etapa == 0){
			$('#error_etapa'+cod_actividades[countActivis]).html('Seleccione la Etapa');
			return false;
		}
		else{
			$('#error_etapa'+cod_actividades[countActivis]).html('');
		}

		var control_valor = $('#control_valor_chek'+cod_actividades[countActivis]).val();
		var valor_etapa =  $('#valor_etapa'+cod_actividades[countActivis]).val();
		var other_valor = $('#valor'+cod_actividades[countActivis]).val();

		other_valor = other_valor.toString().replace(/\./g,'');

		//Validación valor etapa
		if(control_valor == 1){
			if(parseFloat(other_valor) >= parseFloat(valor_etapa)){
				$('#error_valor_etpa'+cod_actividades[countActivis]).html('No puede ser mayor al valor de la Etapa');
				return false;
			}
			else{
				$('#error_valor_etpa'+cod_actividades[countActivis]).html('');
			}
			valor_validar = other_valor;
		}
		else{
			control_valor = 0;
			valor_validar = valor_etapa;
		}

		array_clasificadores = $('select[name="selClasificador'+cod_actividades[countActivis]+'[]"]').map(function () {
			return this.value;
		}).get();

		cantidad_clasificadores = array_clasificadores.length;
		
		//Validación Clasificadores
		var num_clasificadores = 0;
		for (let dto_clasificadores = 0; dto_clasificadores < cantidad_clasificadores; dto_clasificadores++) {
			var clasificador_etapa = array_clasificadores[dto_clasificadores];
			
			if(clasificador_etapa == 0){
				num_clasificadores++;
			}
		}
	
		if(num_clasificadores > 0){
			$("#error_clasificador"+cod_actividades[countActivis]).fadeIn('300');
			$('#error_clasificador'+cod_actividades[countActivis]).html('Debe Seleccionar los clasificadores');
			return false;
		}
		else{
			$("#error_clasificador"+cod_actividades[countActivis]).fadeOut('300');
			$('#error_clasificador'+cod_actividades[countActivis]).html('');
		}

		//Validación Valor Clasificador
		var dscrmncion_clsfcdor = 0;
		var total_clsfcdor = 0;
		var uno_min = 0;
		$("input[name='valor_clasificador"+cod_actividades[countActivis]+"[]']").each(function(indice, elemento) {
			var valor_clsdcdor = $(elemento).val();
			valor_clsdcdor = valor_clsdcdor.toString().replace(/\./g,'');

			if(valor_clsdcdor == ''){
				dscrmncion_clsfcdor++;
			}else if(valor_clsdcdor == 0){
				uno_min++;	
			}
			else{
				total_clsfcdor = parseFloat(total_clsfcdor) + parseFloat(valor_clsdcdor);
			}
		});

		if(dscrmncion_clsfcdor > 0){
			$("#error_valor_clsificador"+cod_actividades[countActivis]).fadeIn('300');
			$('#error_valor_clsificador'+cod_actividades[countActivis]).html('Debe discriminar el valor por cada Clasificador');
			return false;
		}
		else if (uno_min>0){
			$("#error_valor_clsificador"+cod_actividades[countActivis]).fadeIn('300');
			$('#error_valor_clsificador'+cod_actividades[countActivis]).html('El valor debe ser minimo uno');
			return false;
			
		}

		else{
			$("#error_valor_clsificador"+cod_actividades[countActivis]).fadeOut('300');
			$('#error_valor_clsificador'+cod_actividades[countActivis]).html('');
		}

		//Valor de la Discriminación 
		if(parseFloat(valor_validar) == parseFloat(total_clsfcdor)){
			$("#error_valor_clsificador"+cod_actividades[countActivis]).fadeOut('300');
			$('#error_valor_clsificador'+cod_actividades[countActivis]).html('');
		}
		else{
			$("#error_valor_clsificador"+cod_actividades[countActivis]).fadeIn('300');
			$('#error_valor_clsificador'+cod_actividades[countActivis]).html('El valor discriminado no coincide con el valor Solicitado');
			return false;
		}

		var cantidad_asignacion = $('#cantidad_asignaciones'+codigo_etapa).val();
		
		 
		if(cantidad_asignacion > 0){
			var valor_tomar_asignacion = 0;
			$("input[name='codigo_recurso"+codigo_etapa+"[]']").each(function(indice, elemento) { 
				var codigo_asignacion = $(elemento).val();
				var recurso_asignado = $('#recurso_asignado'+codigo_asignacion).val();
				var fuente_cambio = $('#fuentes_asgnacion'+codigo_asignacion).val();
				var cambio_valor = $('input:checkbox[name=checkCmbioval'+codigo_asignacion+']:checked').val();

				fuente_cambio = fuente_cambio.toString().replace(/\./g,'');

				if(!cambio_valor){
					valor_tomar_asignacion = parseFloat(valor_tomar_asignacion) + parseFloat(recurso_asignado);
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
					valor_tomar_asignacion = parseFloat(valor_tomar_asignacion) + parseFloat(fuente_cambio);					
				}
			});

			if(parseFloat(valor_validar) == parseFloat(valor_tomar_asignacion)){
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

		dscrmncion_clsfcdor = 0;
		total_clsfcdor = 0;

	}
	//Fin Validacion Etapas y valores

	var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#solicitudcdpform').serialize();
	
	
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		
		success: function (data) {
			var valor = data
			$('#frmModal').modal('hide');
			$('.modal-backdrop').remove();
			$('#dataSolicitud').load("dtasolicitudcdp");  
			swal({
				title: "Registro exitoso codigo de solicitud: "+valor,
				icon: "success",
				button: "OK",
			}); 
		}
	});
	return false;
}