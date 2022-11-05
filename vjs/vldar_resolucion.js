function validar_resolucion(){
	
	$("#resolucionform").validate({
		rules: {
            txtNombre:{
                required: true,
				minlength:3,
            },
			txtDescripcion:{
				required: true,
			},
			txtUrl:{
				required: true,
			},

		},

		messages:{
			txtNombre:{
                required: "Digite el Nombre",
                minlength:"Debe ser mayor a 3 caracteres",
			},
			txtDescripcion:{
				required: "Digite la Descripción",
			},
			txtUrl:{
				required: "Ingrese la Direccion del Documento",
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
					$("#tablaResolucones").load("dtaresoluciones");
                }
            });
			
            return false; 
		
		}
	});

}

