function validar_formActividadPoai(){

	var selSedes = new Array();

	
	 //Inicio Validación actividades
	selSedes = $('[name="selSedes[]"]:checked').map(function () {
		return this.value;
	}).get();

	cantidad_indicador = selSedes.length;

	if(cantidad_indicador == 0){
	$('#error_selSedes').html('Seleccione al menos un indicador');
	return false;
	}
	else{
	$('#error_selSedes').html('');
	}

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
				minlength:10,
				maxlength:150,
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
				min : 1
			}

			
		},

		

		messages:{
			textActividad:{
                required: "Digite la Descripción de la Actividad",
                minlength:"Debe ser mayor a 3 letras",
			},
			textObjetivo:{
				required: "Digite el Objetivo de la Actividad",
				minlength:"Debe ser mayor a 10 letras",
				maxlength: "Debe ser menor a 150 letras",
			},
			chkestado:{
                required: "Seleccione un Estado",
			},
			txtUnidad:{
				required: "Ingrese la Unidad", 
				min: "debe ser minimo 1"
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
