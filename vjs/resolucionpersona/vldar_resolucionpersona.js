function validar_resolucionpersona(){
	
	$("#resolucionpersona").validate({
		rules: {
            txtNumero:{
                required: true,
            },
			txtFecha:{
				required: true,
			},
			chkestado:{
				required: true,
			},

		},

		messages:{
			txtNumero:{
                required: "Digite el Numero de resolucion",
			},
			chkestado:{
				required: "Digite la Descripción",
			},
			txtFecha:{
				required:"Seleccione la fecha",
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
            var capa_direccion = $('#capa_direccion').val();
            var url_direccion = $('#url_direccion').val();
			
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					$('.modal-backdrop').remove();
					$(capa_direccion).load(url_direccion);
                }
            });
			
            return false; 
		
		}
	});

}

