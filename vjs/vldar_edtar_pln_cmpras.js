function validar_plancompras(){
	
	$("#editarplancompraform").validate({
		rules: {
			
		},

		messages:{
			

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
			var code_acccion=$('#codigo_accion').val();
			var codigo_formulario = $('#codigo_formulario').val();
			var url_proceso = $('#url').val();
			//alert(url_proceso);

			$.ajax({
				type: "POST",
				url: url_proceso,
				data: $(form).serialize(),
				success: function (data, status) {
                    $('#frmModalEtapaEditar'+codigo_formulario).modal('hide');
					$('#frmModalEtapaEditar'+codigo_formulario).modal({backdrop: false});

                    $('#registroActividad'+code_acccion).load("datainfoaccion?codigo_accion="+code_acccion);

				}
			});

			return false;

		}
	});


}
	