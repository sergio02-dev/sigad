function validar_niveluno(){
	
	$("#nivelunoform").validate({
		rules: {
            txtNombre:{
                required: true,
				minlength:3,
			},
			txtReferenciaCompleta:{
				required: true,
				minlength:1,
			},
			selOficina:{
                selectOficina: true,
            },
            selCargo:{
                selectCargo: true,
            },
		},

		messages:{
			txtNombre:{
                required: "Digite el Nombre",
                minlength:"Debe ser mayor a 3 letras",
			},
			txtReferenciaCompleta:{
				required: "Digite la referencia",
				minlength: "Debe ser mayor a 1 letras",
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
			var codigo=$('#codigoPlanDesarrollo').val();

			//alert(codigo+" url "+url_proceso);

			//document.getElementById('botonGuardar').disabled=true;

			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					
					$('.modal-backdrop').remove();

					//alert("Aca "+codigo);
					$("#tablaNivelUno").load("dataniveluno?codigoPlanDesarrollo="+codigo);
                }
            });
			
            return false; 
		
		}
	});

	jQuery.validator.addMethod('selectOficina', function (value) {
		return (value != '0');
	}, "Seleccione una Oficina");	

    jQuery.validator.addMethod('selectCargo', function (value) {
		return (value != '0');
	}, "Seleccione un Responsable");

    
}

