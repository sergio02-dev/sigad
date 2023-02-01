function validar_equipo(){
	//alert('hola');
	
	$("#equipopdifrm").validate({
		rules: {
			selLineaEquipo: {
				selectLineaEquipo: true,
			},
			selSublineaEquipo:{
				selectSublineaEquipo: true,
			},
			selEquipo:{
				required: true,
                minlength:3,
			},
			selCaracteristicas:{
				required: true,
                minlength:10,
			},
            selValorUnitario:{
                required:true,
                min:1,

            }

		},

		messages:{
			selEquipo:{
                required: "Digite el equipo",
                minlength:"Debe ser mayor a 3 caracteres",
			},
			selCaracteristicas:{
				required: "Digite la caracteristica del equipo",
                minlength:"Debe ser mayor a 10 caracteres",
			},
			selValorUnitario:{
				required:"Debe digitar este dato",
				min:"Debe digitar un valor mayor a 1",
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
	
					swal({
						title: "Registro Exitoso",
						text: "",
						icon: "success",
						button: "OK",
			
					  });
                }
            });
			
            return false; 
		
		}
	});

	
	jQuery.validator.addMethod('selectLineaEquipo', function (value) {
		return (value != '0');
	}, "Seleccione una linea de equipo");

	jQuery.validator.addMethod('selectSublineaEquipo', function (value) {
		return (value != '0');
	}, "Seleccione una sublinea de equipo");
}

