function validar_aperturareporte(){
	//alert('Hola');
	$("#aperturareporteform").validate({
		rules: {
            txtFechaInicio:{
                required: true,
            },
			txtFechaFin:{
                required: true,
			}

		},

		messages:{
			txtFechaInicio:{
                required: "Digite la Fecha de Inicio",
			},
			txtFechaFin:{
                required: "Digite la Fecha de Finalización",
               // minlength:"Debe ser mayor a 3 letras",
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

					$("#tablaAperturaReporte").load("dataaperturareporte");
                }
            });
			
            return false; 
		
		}
	});

}

