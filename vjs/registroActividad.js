function changeTipoAvance(){

	var selTipoAvance = $('#selAvance').val();

	if(selTipoAvance=='1'){
		$('#datologrado').fadeOut(1200);
	}
	else if(selTipoAvance=='2'){
		$('#datologrado').fadeIn(1200);
	}

}




function validar_formregistroactividad(){
	var codigoActividadRealizada=$('#codigoActividadRealizada').val();
	var valorAcumulado=$('#valorAcumulado').val();
	var textCantidad=$('#textCantidad').val();

	var url_proceso = $('#url').val();

	var valorValida=parseFloat(valorAcumulado)+parseFloat(textCantidad);

	if(valorValida>=100){
		$('#datologrado').fadeIn(1200);
	}

	$('#totalValidacion').val(valorValida);

	
	$("#tipoactividadform").validate({
		rules: {
			selTipoActividad:{
				selectTipoActividad: true,
			},
			textNumeroVeces:{
				required: true,
				minlength:1,
			},
			selAvance:{
				selectTipoAvance: true,
			},
			textCantidad:{
				required: true,
				minlength:1,
			},
			textNombreAcuerdo:{
				required: function(element){
                    	return $('#selAvance').val() == '2' || $('#totalValidacion').val() >= 100;
					},
				minlength:6,
			},
			textNombreTitulo:{
					required: function(element){
                    	return $('#selAvance').val() == '2' || $('#totalValidacion').val() >= 100;
					},
				minlength:6,
			},
			totalValidacion:{
				required: true,
				max:100,
			},
		},

		messages:{
			selTipoActividad:{
				required: "Seleccione la actividad realizada",
			},
			textNumeroVeces:{
				required: "Digite numero de veces",
                minlength:"Debe ser mayor a 1 digito",
			},
			selAvance:{
				required: "Seleccione el tipo de avance",
			},
			textCantidad:{
				required: "Digite la cantidad del avance",
				minlength:"Debe ser mayor a 1 digito",
			},
			textNombreAcuerdo:{
				required: "Digite el numero de Acuerdo/Resolución",
				minlength:"Debe ser mayor a 6 digitos",
			},
			textNombreTitulo:{
				required: "Digite Título/Nombre",
				minlength:"Debe ser mayor a 6 digitos",
			},
			totalValidacion:{
				required: "Sobrepasa el alcance del Logro",
				max: "Sobrepasa el alcance del Logro",
			}


		},
		errorPlacement : function(error, element) {
				$(element).closest('.form-group').find('.help-block').html(error.html());
		},
		highlight : function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				$(element).closest('.form-group').find('.help-block').html('');
		},
		submitHandler: function(form){
			
			var tipoACtividad = $('#selTipoActividad').val();
			var numeroVeces = $('#textNumeroVeces').val();
			var url_proceso = $('#url').val();
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
                    // ajax done
                    // do whatever & close the modal
                    $('#frmModal').modal('hide');
					
					$('.modal-backdrop').remove();

                }
            });
			
            return false; 
		
		}
	});

	jQuery.validator.addMethod('selectTipoActividad', function (value) {
			return (value != '0');
		}, "Seleccione la actividad realizada");
        
    
	jQuery.validator.addMethod('selectTipoAvance', function (value) {
			return (value != '0');
		}, "Seleccione el tpo de avance");
		
	
}

