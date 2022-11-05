function validar_plancompra(){
	
	$("#plancompraform").validate({
		rules: {
			txtDescripcion:{
				required: true,
				minlength:3,
			},
			txtCantidad:{
				required: true,
			},
			txtValorUnitario:{
				required: true,
			},
			chkestado:{
				required: true,
			},
		},

		messages:{
			txtDescripcion:{
				required: "Digite la Descripción",
				minlength:"Debe ser mayor a 3 letras",
			},
			txtCantidad:{
				required: "Ingrese la Cantidad",
			},
			txtValorUnitario:{
				required: "Ingrese el Valor Unitario",
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
			var code_acccion=$('#codigo_accion').val();
			var codigo_formulario = $('#codigo_formulario').val();
			var url_proceso = $('#url').val();

			$.ajax({
				type: "POST",
				url: url_proceso,
				data: $(form).serialize(),
				success: function (data, status) {
                    $('#frmModalEtapaEditar'+codigo_formulario).modal('hide');
                    $('#tabla_poai'+code_acccion).load("datainfoaccion?accion_codee="+code_acccion);

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
	