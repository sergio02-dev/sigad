function validar_formplandesarrollo(){
	//alert('Hola');
	$("#plandesarrolloform").validate({
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
			txtNivelUno:{
                required: true,
				minlength:3,
			},
			txtReferenciaNivelUno:{
				required: true,
				minlength: 1,
			},
			txtNivelDos:{
                required: true,
				minlength:3,
			},
			txtReferenciaNivelDos:{
				required: true,
				minlength: 1,
			},
			txtNivelTres:{
                required: true,
				minlength:3,
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
			selActoAdmin:{
				required: "Seleccione el Acto Administrativo",
			},
			txtNivelUno:{
                required: "Digite el Nombre del Nivel Uno",
                minlength:"Debe ser mayor a 3 letras",
			},
			txtReferenciaNivelUno:{
                required: "Digite la Referencia del Nivel Uno",
                minlength:"Debe ser mayor a 1 letras",
			},
			txtNivelDos:{
                required: "Digite el Nombre del Nivel Dos",
                minlength:"Debe ser mayor a 3 letras",
			},
			txtReferenciaNivelDos:{
                required: "Digite la Referencia del Nivel Dos",
                minlength:"Debe ser mayor a 1 letras",
			},
			txtNivelTres:{
                required: "Digite el Nombre del Nivel Tres",
                minlength:"Debe ser mayor a 3 letras",
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
			var url_proceso=$('#url').val();
			//alert(url_proceso);
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
                    // ajax done
                    // do whatever & close the modal
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

