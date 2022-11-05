/**
 * 25 de junio de 2019
 * validación formulario persona 
 * TDI AMC
 * */

function validar_perfilPersona(){

	$("#perfilPersonaForm").validate({
		rules: {
			selPerfil:{
				selectPerfil: true,
			}, 
			textUsuario:{
				required: true,
				minlength: 6,
            },
            sistema:{
                required: true,
                minlength: 1,
            }
		},

		messages:{
			textUsuario:{
				required: "Digite el Nombre del Usuario",
				minlength:"debe ser mayor a 6 caracteres",
			},
			sistema:{
				required: "Seleccione por lo menos una Opción",
				minlength:"debe ser al menos 1",
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
			
			var url_proceso = $('#url_proceso').val();
			//alert(url_proceso);
            
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
                    // ajax done
                    // do whatever & close the modal
					$('#frmModal').modal('hide');
					
					$("#persona").load("datapersona");
                }
            });		
            return false; 
			
		}
	});

	jQuery.validator.addMethod('selectPerfil', function (value) {
		return (value != '0');
	}, "Seleccione el Perfil");

}