function validar_solicitud_cdp(){
	var selAccion = $('#selAccion').val();
    var chkestado = $('input:radio[name=chkestado]:checked').val();


	if(selAccion == 0){
        $("#error_accion").fadeIn('300');
        $("#error_accion").html('Seleccione una Opcion');
        document.getElementById("selAccion").focus();
        return false;
    }
    else{
        $("#error_accion").fadeOut('300');
    }	

	if(chkestado == 0){
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


	var valor_solicitad_en_etapas = 0;
	for (let index = 0; index < cod_etapas.length; index++) {
		var valetapa = $('#valetapa'+cod_etapas[index]).val();
		var control_valor = $('#control_valor_chek'+cod_etapas[index]).val();
		var other_valor = $('#valor'+cod_etapas[index]).val();

		if(control_valor == 1){
			if(parseFloat(other_valor) == 'NaN'){
			}
			else{
				valor_solicitad_en_etapas = valor_solicitad_en_etapas + parseFloat(other_valor);
			}

			if(parseFloat(valetapa) <parseFloat(other_valor)){
				$('#error_valor_etpa'+cod_etapas[index]).html('No puede ser mayor al valor de la Etapa');
				return false;
			}
			else{
				$('#error_valor_etpa'+cod_etapas[index]).html('');
			}
		}
		else{
			control_valor = 0;
			valor_solicitad_en_etapas = valor_solicitad_en_etapas + parseFloat(valetapa);
		}
	}


	//Inicio Validacion Valor fuentes solicitado 
	//Codigos fuentes
	codigos_fuentes = $('[name="fuenntes[]"]:checked').map(function () {
						return this.value;
				}).get();

	cantidad_fuentes =  codigos_fuentes.length;

	if(cantidad_fuentes == 0){
		$('#error_fuente').fadeIn(100);
		$('#error_fuente').html('Debe seleccionar la fuente de Financiacion y especificar el valor');
		return false;
	}
	else{
		$('#error_fuente').fadeOut(100);
		$('#error_fuente').html('');
	} 
	
	//validar campos valor fuente 
	for (let list_fuente = 0; list_fuente < codigos_fuentes.length; list_fuente++) {

		if($('#valorpoai'+codigos_fuentes[list_fuente]).val() == ''){
			$('#error_valor_fuente'+codigos_fuentes[list_fuente]).fadeIn(100);
			$('#error_valor_fuente'+codigos_fuentes[list_fuente]).html('Ingrese el Valor');
			return false;
		}
		else{
			$('#error_valor_fuente'+codigos_fuentes[list_fuente]).fadeOut(100);
			$('#error_valor_fuente'+codigos_fuentes[list_fuente]).html('');
		}
	}

	//suma valores fuentes
	var suma_fuente = 0;

	for (let index = 0; index < codigos_fuentes.length; index++) {
		var valor_fuente = $('#valorpoai'+codigos_fuentes[index]).val();
		suma_fuente = parseInt(suma_fuente) + parseInt(valor_fuente);   
	}

	//alert("valor solicitado: "+valor_solicitad_en_etapas+" suma fuentes: "+suma_fuente);
	if(parseFloat(valor_solicitad_en_etapas) == parseFloat(suma_fuente)){
		$('#error_valor_solicitado').fadeOut(100);
		$('#error_valor_solicitado').html('');
	}
	else{
		$('#error_valor_solicitado').fadeIn(100);
		$('#error_valor_solicitado').html('El valor solictado no coincide con el valor total solictado de las etapas');
		return false;
	}
	//Fin Validacion Etapas y valores

	var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#solicitudcdpform').serialize();
	
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		success: function (data) {
			if(data == 0){
				$('#error_recursos_disponibles').fadeOut(1);
				$('#error_recursos_disponibles').html('');
				$('#frmModal').modal('hide');
				$('.modal-backdrop').remove();
				$('#dataSolicitud').load("dtasolicitudcdp");                          
			}
			else{
				$('#error_recursos_disponibles').fadeIn(1);
				$('#error_recursos_disponibles').html('No hay recursos disponibles');
				return false;
			}
			
		}
	});

}