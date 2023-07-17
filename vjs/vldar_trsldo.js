function validar_traslados(){
	var selAccion = $('#selAccion').val();
    var selAcuerdo = $('#selAcuerdo').val();
    var selRecurso = $('#selRecurso').val();
    var selSede = $('#selSede').val();
    var selIndicador = $('#selIndicador').val();
    var chkestado = $('input:radio[name=chkestado]:checked').val();
    var maximo_recursos = $('#maximo_recursos').val();
    var txtSaldo = $('#txtSaldo').val();
    var saldo = 0;
    var capa_direccion = $('#capa_direccion').val();
    var url_direccion = $('#url_direccion').val();

    saldo = txtSaldo.toString().replace(/\./g,'');

	if(selAccion == 0){
        $("#error_accion").fadeIn('300');
        $("#error_accion").html('Seleccione una Acción');
        document.getElementById("selAccion").focus();
        return false;
    }
    else{
        $("#error_accion").fadeOut('300');
    }

    if(selAcuerdo == 0){
        $("#error_acuerdo").fadeIn('300');
        $("#error_acuerdo").html('Seleccione un Acuerdo');
        document.getElementById("selAcuerdo").focus();
        return false;
    }
    else{
        $("#error_acuerdo").fadeOut('300');
    }

    if(selRecurso == 0){
        $("#error_recurso").fadeIn('300');
        $("#error_recurso").html('Seleccione una Opción');
        document.getElementById("selAcuerdo").focus();
        return false;
    }
    else{
        $("#error_recurso").fadeOut('300');
    }

    if(selSede == 0){
        $("#error_sede").fadeIn('300');
        $("#error_sede").html('Seleccione un Sede');
        document.getElementById("selSede").focus();
        return false;
    }
    else{
        $("#error_sede").fadeOut('300');
    }

    if(selSede == 0){
        $("#error_sede").fadeIn('300');
        $("#error_sede").html('Seleccione un Sede');
        document.getElementById("selSede").focus();
        return false;
    }
    else{
        $("#error_sede").fadeOut('300');
    }
    
    if(selIndicador == 0){
        $("#error_indicador").fadeIn('300');
        $("#error_indicador").html('Seleccione un Indicador');
        document.getElementById("selIndicador").focus();
        return false;
    }
    else{
        $("#error_indicador").fadeOut('300');
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

    if(selIndicador == 0){
        $("#error_indicador").fadeIn('300');
        $("#error_indicador").html('Seleccione un Indicador');
        document.getElementById("selIndicador").focus();
        return false;
    }
    else{
        $("#error_indicador").fadeOut('300');
    }

    if(saldo == ''){
        $("#error_valor").fadeIn('300');
        $("#error_valor").html('Ingrese el Valor');
        document.getElementById("txtSaldo").focus();
        return false;
    }
    else{
        $("#error_valor").fadeOut('300');
    }

    if(parseFloat(saldo) > parseFloat(maximo_recursos)){
        $("#error_valor").fadeIn('300');
        $("#error_valor").html('El valor no puede ser mayor al disponible');
        document.getElementById("txtSaldo").focus();
        return false;
    }
    else{
        $("#error_valor").fadeOut('300');
    }

	var url_proceso = $('#url_proceso').val();
	var data_enviar = $('#trasladopoaiform').serialize();
	
	$.ajax({
		type: "POST",
		url: url_proceso,
		data: data_enviar,
		success: function (data) {
			$('#frmModal').modal('hide');
			$('.modal-backdrop').remove();
            $(capa_direccion).load(url_direccion);  
		}
	});
	return false;
}