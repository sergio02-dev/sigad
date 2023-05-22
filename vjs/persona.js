/**
 * 25 de junio de 2019
 * validación formulario persona 
 * TDI AMC
 * */
function validar_formpersona(){

	$("#personaform").validate({
		rules: {
			selTipoIdentificacion:{
				selectTipoIdentificacion: true,
			}, 
			textIdentificacion:{
				required: true,
				minlength: 6
			},
			textNombres:{
				required: true,
				minlength:2,
			},
			textPrimerApellido:{
				required: true,
				minlength:2,
			},
			chkgenero:{
				required: true,
			},
			chkestado:{
				required: true,
			},
			selEntidad:{
				selectEntidad: true,
			},
			selFacultad:{
				selectFacultad: true,
			},
			txtEmail:{
				required: true,
			}
		},

		messages:{
			textIdentificacion:{
				required: "Digite la identificación",
				minlength:"debe ser mayor a 6 caracteres",
			},
			selEntidad:{
				required: "Seleccione vicerrectoria",
				
			},
			selFacultad:{
				required: "Seleccione facultad",
				
			},
			textNombres:{
				required: "Digite los nombres",
				minlength:"debe ser mayor a 2 caracteres",
			},
			textPrimerApellido:{
				required: "Digite el primer apellido",
				minlength:"debe ser mayor a 2 caracteres",
			},
			chkgenero:{
				required: "Seleccione el Genero",
			},
			chkestado:{
				required: "Seleccione el Estado",
			},
			txtEmail:{
				required: "Debe Ingresar el correo",
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
			var url_proceso = $('#url_proceso').val();
            
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					$("#persona").load("datapersona");
                }
            });		
            return false; 
		}
	});

	jQuery.validator.addMethod('selectTipoIdentificacion', function (value) {
		return (value != '0');
	}, "Seleccione el Tipo de Identificación");
	jQuery.validator.addMethod('selectFacultad', function (value) {
		return (value != '0');
	}, "Seleccione una facultad");
	jQuery.validator.addMethod('selectEntidad', function (value) {
		return (value != '0');
	}, "Seleccione una vicerrectoria");

}