function validar_actualizar_plan(){

	$("#actualizarplanform").validate({
		rules: {
            txtNombre:{
                required: true,
				minlength:3,
            },
			selYearInicio:{
				selectYearInicio: true,
            },
            selYearFin:{
				selectYearFin: true,
			},
			selActoAdmin:{
				selectActoAdmin: true,
			},
			selResponsable:{
				selectResponsable: true,
			},
			selOficina:{
				selectOficina: true,
			}
		},
		messages:{
			txtNombre:{
                required: "Digite el Nombre",
                minlength:"Debe ser mayor a 3 letras",
			},
			selYearInicio:{
				required: "Seleccione el Año de Inicio",
			},
			selYearFin:{
				required: "Seleccione el Año de Fin",
			},
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
			var url_proceso=$('#url').val();
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					$('.modal-backdrop').remove();
					$("#tablaPlanDesarrollo").load("dataplandesarrollorecarga");
                }
            });
			
            return false; 
		
		}
	});

    jQuery.validator.addMethod('selectYearInicio', function (value) {
        return (value != '0');
    }, "Seleccione el Año de Inicio");


    jQuery.validator.addMethod('selectYearFin', function (value) {
        return (value != '0');
    }, "Seleccione el Año de Fin");
    
    jQuery.validator.addMethod('selectActoAdmin', function (value) {
        return (value != '0');
    }, "Seleccione el Acto Administrativo");
        
    jQuery.validator.addMethod('selectResponsable', function (value) {
        return (value != '0');
    }, "Seleccione el Responsable");

    jQuery.validator.addMethod('selectOficina', function (value) {
        return (value != '0');
    }, "Seleccione la Oficina");
}

