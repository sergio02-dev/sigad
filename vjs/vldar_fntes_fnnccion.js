function validar_fuente(){
	
	$("#fuentesfinanciciacion").validate({
		rules: {
            txtNombre:{
                required: true,
				minlength:3,
            },
			txtDescripcion:{
				required: true,
			},
			chkestado:{
				required: true,
			},
			selTipoFuente:{
				selectTipoFuente : true,
			},
			selClasificacion:{
				selectClasificacion : true,
			},
			selClasificacionPlncion:{
				selectClasificacionPlncion: true,
			},
			txtCodigoLinix:{
				required: true,
			},
			txtReferenciaLinix:{
				required: true,
			}
		},

		messages:{
			txtNombre:{
                required: "Digite el Nombre",
                minlength:"Debe ser mayor a 3 caracteres",
			},
			txtDescripcion:{
				required: "Digite la Descripción",
			},
			chkestado:{
				required: "Seleccione una opción",
			},
			txtCodigoLinix:{
				required: "Digite el Código Linix",
			},
			txtReferenciaLinix:{
				required: "Digite la Referencia Linix",
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
			//document.getElementById('botonGuardar').disabled=true;
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					window.location.href = 'fuentesfinanciacio';
                }
            });
			
            return false; 
		
		}
	});

	
	jQuery.validator.addMethod('selectTipoFuente', function (value) {
		return (value != '0');
	}, "Seleccione el Grupo");
	
	jQuery.validator.addMethod('selectClasificacion', function (value) {
		return (value != '0');
	}, "Seleccione la Clasificación Presupuesto");

	jQuery.validator.addMethod('selectClasificacionPlncion', function (value) {
		return (value != '0');
	}, "Seleccione la Clasificación Planeación");
}

