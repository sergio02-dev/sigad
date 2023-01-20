function validar_formregistroactividad(){
	let recurso = $('#recursoAccion').val();
	
	$("#planAccionform").validate({
		rules: {
			objetoAccion:{
				required: true,
				minlength:3,
			},
			recursoAccion:{
				required: true,
				min: 1,
			},
			chkestado:{
				required: true,
			},
			logroEjecutado:{
				required: true,
				max: 100,
			},
			logroAccion:{
				required: true,
				min: 1,
			}
			/*
			codigoClasificador:{
				required: function(element){
					return parseFloat(recurso) > 0;
				},
			}*/
		},

		messages:{
			objetoAccion:{
				required: "Digite la Descripción/Objeto",
				minlength:"Debe ser mayor a 3 letras",
			},
			recursoAccion:{
				required: "Ingrese el Recurso",
				min: "Debe ser mayor a 1 el recurso",
			},
			chkestado:{
				required: "Seleccione un Estado",
			},
			logroEjecutado:{
				required: "Ingrese el Valor",
				max: "El valor sobrepasa el  total del avance de las etapas."
			},
			logroAccion:{
                required: "Ingrese el peso de la etapa",
				min: "El peso de la etapa debe ser mayor a 0"
			}
			
			/*txtDescripcionClasificador:{
				required: "Ingrese la Descripción"
			},
			codigoClasificador:{
				required: "Ingrese el Codigo Clasificador",
			}*/



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
			var code_acccion=$('#codigo_accion').val();
			var codigo_formulario = $('#codigo_formulario').val();
			var codigo_poai = $('#codigo_poai').val();

			if(codigo_poai){
				var url_proceso = "crudupdatepoai";
			}
			else{
				var url_proceso = "crudregistroplanaccion";
			}

			$.ajax({
				type: "POST",
				url: url_proceso,
				data: $(form).serialize(),
				success: function (data, status) {

					var valor = data.split('-');

					var valorEtapas =  (valor[0]);
					var valortotal=  (valor[1]);
					
					var mensaje="El valor sobrepasa el 100% del total de las actividades.";
					var mensajeestapas="El valor sobrepasa el  total de las etapas permitidas.";
					
					if(valortotal==1){
						document.getElementById('error_valor').innerHTML = mensaje;
					}
					else{
						$('#frmModalEtapa'+codigo_formulario).modal('hide');
						$('#frmModalEtapa'+codigo_formulario).modal({backdrop: false});
						
						$('#registroActividad'+code_acccion).load("datainfoaccion?codigo_accion="+code_acccion);

						$('#frmModalEtapaEditar'+codigo_formulario).modal('hide');
						$('#frmModalEtapaEditar'+codigo_formulario).modal({backdrop: false});

						$('#registroActividad'+code_acccion).load("datainfoaccion?codigo_accion="+code_acccion);
						$('.modal-backdrop').remove();
					}

				}
			});

			return false;

		}
	});

	
	jQuery.validator.addMethod('selectFuenteFinanciacion', function (value) {
		return (value != '0');
	}, "Seleccione una Fuente de Financiación");

	jQuery.validator.addMethod('selectCodigoClasificacion', function (value) {
		return (value != '0');
	}, "Seleccione el Codigo Claficador Presupuestal");


	

	$("#recursoAccion").on({
		"focus": function (event) {
			$(event.target).select();
		},
		"keyup": function (event) {
			$(event.target).val(function (index, value ) {
				return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
			});
		}
	});

}
	