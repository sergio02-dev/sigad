function validarIndicador(){
	$("#indicadorform").validate({
		rules: {
			txtUnidadMedida:{
                required: true,
            },
			txtLineaBase:{
                required: true,
			},
			txtMetaResultado:{
                required: true,
			},
			selTipoComportamiento:{
                selectTipoComportamiento: true,
			},
			selTendencia:{
                selectTendencia: true,
			},
			selSedes:{
				selectSede: true,
			}
		},

		messages:{
			txtUnidadMedida:{
				required: "Ingrese la Unidad de Medida",
			},
			txtLineaBase:{
				required: "Ingrese la line Base",
			},
			txtMetaResultado: {
				required: "Ingreso Meta de Resultado",
			},
			


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
			var codigo_accion=$('#codigoAccion').val();
			var codigo_planDesarrollo=$('#codigo_planDesarrollo').val();
			//alert(url_proceso);
			document.getElementById('boton_guarda_modifica').disabled=true;
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					$('.modal-backdrop').remove();

					$("#tabla_indicador").load("dataindicador?codigo_planDesarrollo="+codigo_planDesarrollo+'&codigo_accion='+codigo_accion);
                }
            });
			
            return false; 
		
		}
	});

    
        jQuery.validator.addMethod('selectTipoComportamiento', function (value) {
			return (value != '0');
		}, "Seleccione un Tipo de Comportamiento");
		
		jQuery.validator.addMethod('selectTendencia', function (value) {
			return (value != '0');
		}, "Seleccione una Tendencia");
		
		jQuery.validator.addMethod('selectSede', function (value) {
			return (value != '0');
		}, "Seleccione una opción");
	
    
}

