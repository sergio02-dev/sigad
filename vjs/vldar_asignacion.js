function validar_asignacion(){
	var selFuente = $('#selFuente').val();
    var txtResurso = $('#txtResurso').val();
    var url_direccion = $('#url_direccion').val();
    var saldo = txtResurso.toString().replace(/\./g,'');
    var rcrso_disponible = $('#rcrso_disponible').val();
    ///alert(url_direccion);

	if(selFuente == 0){
        $("#error_fuente").fadeIn('300');
        $("#error_fuente").html('Seleccione una Opcion');
        document.getElementById("selFuente").focus();
        return false;
    }
    else{
        $("#error_fuente").fadeOut('300');
    }	

	if(txtResurso == 0){
        $("#error_recurso").fadeIn('300');
        $("#error_recurso").html('Ingrese el Valor');
        document.getElementById("txtResurso").focus();
        return false;
    }
    else{
        $("#error_recurso").fadeOut('300');
    }

    if(parseInt(saldo) > parseInt(rcrso_disponible)){
        $("#error_saldo").fadeIn('300');
        $("#error_saldo").html('No hay recursos Disponible');
        return false;
    }
    else{
        $("#error_saldo").fadeOut('300');
    }

	var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#asignacionrecursoform').serialize();
	
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		success: function (data) {
            if(data == 1){
                $("#error_asignacion").fadeIn('300');
                $("#error_asignacion").html('Sobre pasa el valor de la Etapa');
                return false;
            }
            else{
                $('.lista_asignacion').load(url_direccion);	
            }
		}
	});

}