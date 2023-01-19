function validar_niveldos(){
	//alert('Hola');
	$("#niveldosform").validate({
		rules: {
			selNivelUno:{
                selectNivelUno: true,
            },
            txtNombre:{
                required: true,
				minlength:3,
			},
			txtObjetivo:{
				required: true,
				minlength:3,
			},
			/*selResponsable:{
				selectResponsable: true,
			},*/

		},

		messages:{
			selNivelUno:{
				required: "Seleccione una opción",
			},
			txtNombre:{
                required: "Digite la Descripción",
                minlength:"Debe ser mayor a 3 letras",
			},
			txtObjetivo:{
                required: "Digite el Objetivo",
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
			var codigo_planDesarrollo=$('#codigo_planDesarrollo').val();
			//alert(codigo_planDesarrollo+' ----- '+url_proceso);
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
                    // ajax done
                    // do whatever & close the modal
					$('#frmModal').modal('hide');
					$('.modal-backdrop').remove();

					$("#tablaNivelDos").load("inforesponsable?codigoPlanDesarrollo="+codigo_planDesarrollo);
				},
				error:{

				}
            });
			
            return false; 
		
		}
	});

        jQuery.validator.addMethod('selectNivelUno', function (value) {
                return (value != '0');
			}, "Seleccione una opción");
			
		/*jQuery.validator.addMethod('selectResponsable', function (value) {
			return (value != '0');
			}, "Seleccione un Responsable");	*/
        
    
}

