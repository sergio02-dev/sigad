function validar_formActividadPoai(){
	$("#actividaPoaiform").validate({
		rules: {
			textActividad:{
				required: true,
				minlength:3,
			},
			vigenciaActividad:{
				selectvigenciaActividad: true,
			},
			textObjetivo:{
				required: true,
			},
			selSedes:{
				selectSede: true,
			},
			chkestado:{
				required: true,
			},
			//minimo una unidad
			txtUnidad:{
				required: true,
			}
		},

		messages:{
			textActividad:{
                required: "Digite la Descripción de la Actividad",
                minlength:"Debe ser mayor a 3 letras",
			},
			chkestado:{
                required: "Seleccione un Estado",
			},
			textObjetivo:{
				required: "Digite el Objetivo de la Actividad",
			},
			txtUnidad:{
				required: "Ingrese la Unidad"
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
			var code_acccion=$('#codigo_accion').val();
			var codigoActividad = $('#codigoActividad').val();

			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {

					var mensaje="El valor sobrepasa el  total de las actividades permitidas.";
					if(data==1){
						document.getElementById('error_valor').innerHTML = mensaje;
					}
					else{
						$('#frmModal'+codigoActividad).modal('hide');
						$('#frmModal'+codigoActividad).modal({backdrop: false});
						$('#registroActividad'+code_acccion).load("datainfoaccion?codigo_accion="+code_acccion);
					}
                }
            });

            return false;

		}
	});


	jQuery.validator.addMethod('selectvigenciaActividad', function (value) {
		return (value != '0');
	}, "Seleccione la Vigencia");
	
	jQuery.validator.addMethod('selectSede', function (value) {
		return (value != '0');
	}, "Seleccione la Sede");
}
