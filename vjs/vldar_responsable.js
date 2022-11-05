function validar_responsable(){
	
	$("#rsponsableform").validate({
		rules: {
            selOficina:{
                selectOficina: true,
            },
            selResponsable:{
                selectResponsable: true,
            },
			chkestado:{
				required: true,
			},

		},

		messages:{
			chkestado:{
                required: "Seleccione una Opición",
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
			var url_proceso = $('#url').val();
            var capa_direccion = $('#capa_direccion').val();
            var url_direccion = $('#url_direccion').val();
            //document.getElementById('botonGuardar').disabled=true;
			//alert("Capa Direccion: "+capa_direccion+" Url Direccion: "+url_direccion);
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					$(capa_direccion).load(url_direccion);
                }
            });
			
            return false; 
		
		}
	});

	jQuery.validator.addMethod('selectOficina', function (value) {
		return (value != '0');
	}, "Seleccione una Oficina");	

    jQuery.validator.addMethod('selectResponsable', function (value) {
		return (value != '0');
	}, "Seleccione un Responsable");
}

