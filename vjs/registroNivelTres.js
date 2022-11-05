function validar_nivelTres(){
	//alert('Hola');
	$("#niveldosform").validate({
		rules: {
			selNivelUno:{
                selectNivelUno: true,
            },
			selNivelDos:{
                selectNivelDos: true,
			},
			txtNombre:{
                required: true,
				minlength:3,
			},
			selResponsable:{
				selectResponsable: true,
			},
			/*selTendencia:{
				selectTendencia: true,
			},
			selTipoComportamiento:{
				selectTipoComportamiento: true,
			}*/


		},

		messages:{
			txtNombre:{
                required: "Digite la Descripción",
                minlength:"Debe ser mayor a 3 letras",
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
			var codigoPlanDesarrollo=$('#codigoPlanDesarrollo').val();
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

					$("#tablaNivelTres").load("dataniveltres?codigoPlanDesarrollo="+codigoPlanDesarrollo);
                }
            });
			
            return false; 
		
		}
	});

        jQuery.validator.addMethod('selectNivelUno', function (value) {
                return (value != '0');
			}, "Seleccione una opción");
			
		jQuery.validator.addMethod('selectNivelDos', function (value) {
			return (value != '0');
		}, "Seleccione una opción");

		jQuery.validator.addMethod('selectResponsable', function (value) {
			return (value != '0');
		}, "Seleccione un Responsable");	
      /*  jQuery.validator.addMethod('selectTendencia', function (value) {
			return (value != '0');
		}, "Seleccione una Tendencia");
		
		jQuery.validator.addMethod('selectTipoComportamiento', function (value) {
			return (value != '0');
		}, "Seleccione un Tipo de Comportamiento");*/
	
    
}

