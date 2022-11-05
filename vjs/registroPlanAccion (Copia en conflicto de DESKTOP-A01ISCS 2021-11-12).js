function validar_formregistroactividad(){
//alert('Hola');
	$("#planAccionform").validate({
		rules: {
			objetoAccion:{
				required: true,
				minlength:3,
			},
			recursoAccion:{
				required: true,
			},
			logroAccion:{
				required: true,
			},
			chkestado:{
				required: true,
			}
		},

		messages:{
			objetoAccion:{
                required: "Digite la Descripción/Objeto",
                minlength:"Debe ser mayor a 3 letras",
			},
			recursoAccion:{
                required: "Ingrese el Recurso",
			},
			logroAccion:{
                required: "Ingrese el Logro",
			},
			chkestado:{
                required: "Seleccione un Estado",
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
			var codigo_formulario = $('#codigo_formulario').val();
			alert(codigo_formulario);

			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {

					var valor = data.split('-');

					var valorEtapas=  (valor[0]);
					var valortotal=  (valor[1]);
                    // ajax done
					// do whatever & close the modal
					var mensaje="El valor sobrepasa el 100% del total de las actividades.";
					var mensajeestapas="El valor sobrepasa el  total de las etapas permitidas.";
					if(valorEtapas==1){
						document.getElementById('error_valor_etapas').innerHTML = mensajeestapas;
					}
					else if(valortotal==1){
						document.getElementById('error_valor').innerHTML = mensaje;
					}
					else{
						$('#frmModalEtapa'+codigo_formulario).modal('hide');
						$('#frmModalEtapaEditar'+codigo_formulario).modal('hide');
						$('#tabla_poai'+code_acccion).load("datainfoaccion?accion_codee="+code_acccion);
					}

                }
            });

            return false;

		}
	});

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
