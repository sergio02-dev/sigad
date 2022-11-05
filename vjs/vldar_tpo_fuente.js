function validar_tipo_fuente(){
	
	$("#tipofuenteform").validate({
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
					window.location.href = 'tipofuentefinanciacion';
                }
            });
            return false; 
		}
	});

	
}

