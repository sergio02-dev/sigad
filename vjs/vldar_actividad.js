/**
 * Karen Yuliana Palacio Minú
 * Validacion Registro Actividad
 * 27 de Mayo 2021 01.13pm
 */
 function validar_actividad(){

    var maximo_admitido = parseFloat($('#maximo_admitido').val());
	
	$("#rgstroActvdad").validate({
		rules: {
			selTipoActividad:{
				selectTipoActividad: true,
			},
			textNumeroVeces:{
				required: true,
				minlength:1,
			},
			acumulativo:{
				max: 100,
			},
			textCantidad:{
				required: true,
                max: maximo_admitido,
			}
			
		},

		messages:{
			selTipoActividad:{
				required: "Seleccione la actividad realizada",
			},
			textNumeroVeces:{
				required: "Digite numero de veces",
                minlength:"Debe ser mayor a 1 digito",
			},
			textCantidad:{
				required:"Debe digitar este dato",
                max: "Este valor sobre pasa el 100% del acumulado ",
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
			
			var url_proceso = $('#url').val();
			var capa_direccion = $('#capa_direccion').val();
			var url_direccion = $('#url_direccion').val();

			//alert("Capa "+capa_direccion+" Url "+url_direccion);
		
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

	jQuery.validator.addMethod('selectTipoActividad', function (value) {
			return (value != '0');
		}, "Seleccione la actividad realizada");
	

	jQuery.validator.addMethod('selectTipoAvance', function (value) {
			return (value != '0');
		}, "Seleccione el tpo de avance");
			
	
}

