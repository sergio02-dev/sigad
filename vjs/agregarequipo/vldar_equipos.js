function validar_equipos(){
	
	$("#equiposfrm").validate({
		rules: {
            selLineaEquipo:{
                selectequipo: true,
            },
            selSublineaEquipo:{
                selectsubequipo: true,
            },
            txtEquipo:{
                required:true,
                minlength:3,
            },
            txtCaracteristicas:{
                required:true,
                minlength:10,
            },
            selValorUnitario:{
                required: true,
				minlength: 1,
            },
			

		},

		messages:{
			txtEquipo:{
                required: "Digite el Equipo",
                minlength:"Debe ser mayor a 3 caracteres",
			},
            txtCaracteristicas:{
                required: "Digite la descripción de equipo",
                minlength:"Debe ser mayor a 10 caracteres",
			},
			selValorUnitario:{
				required: "Digite un valor",
                minlength: "Digite un valor minimo de uno",
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

                    var equipo = data;
					swal({
						title: "Registro Exitoso",
						text: "Equipo: "+equipo,
						icon: "success",
						button: "OK",
			
					  });
                }
            });
			
            return false; 
		
		}
	});



    jQuery.validator.addMethod('selectequipo', function (value) {
		return (value != '0');
	}, "Seleccione una linea de equipo");
    jQuery.validator.addMethod('selectsubequipo', function (value) {
		return (value != '0');
	}, "Seleccione una sublinea de equipo");
}


