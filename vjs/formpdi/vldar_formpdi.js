function validar_formpdi(){
	var maximo_admitido = parseFloat($('#maximo_admitido').val());

	$("#plancomprasPDIform").validate({
		rules: {
        	inputPlantaFisica:{
                required: true,
				minlength:3,
				
            },
			selCantidad:{
				required: true,
                max: maximo_admitido,
			},
			selSede:{
				selectSede: true,
			},
			selTipoVicerrectoria:{
				selectVicerrectoria: true, 
			},
			selTipoFacultad:{
				selectFacultad: true,
			},
			selDependencia:{
				selectDependencia: true,
			},
			selTipoArea:{
				selectTipoArea: true,
			},
			selCodigoPDI:{
				selectCodigoPDI: true,
			},
			selTipoAccion:{
				selectTipoAccion: true,
			},
			selLineaEquipo:{
				selectLineaEquipo: true,
			},
			selSublineaEquipo:{
				selectSublineaEquipo: true,
			},
			selEquipo:{
				selectEquipo: true,
			},
			selCaracteristicas:{
				selectCaracteristicas: true,
			}

			

		},

		messages:{
			inputPlantaFisica:{
                required: "Digite la caracteristica de planta fisica",
                minlength:"Debe ser mayor a 3 caracteres",
			},
			chkestado:{
				required: "Digite la Descripción",
			},
			selCantidad:{
				required:"Debe digitar este dato",
                max: "Este valor sobre pasa el 100% del acumulado ",
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
            var capa_direccion = $('#capa_direccion').val();
            var url_direccion = $('#url_direccion').val();
			
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

	jQuery.validator.addMethod('selectSede', function (value) {
		return (value != '0');
	}, "Seleccione una sede");
	jQuery.validator.addMethod('selectVicerrectoria', function (value) {
		return (value != '0');
	}, "Seleccione una vicerrectoria");
	jQuery.validator.addMethod('selectFacultad', function (value) {
		return (value != '0');
	}, "Seleccione una Facultad");
	jQuery.validator.addMethod('selectDependencia', function (value) {
		return (value != '0');
	}, "Seleccione una dependencia");
	jQuery.validator.addMethod('selectTipoArea', function (value) {
		return (value != '0');
	}, "Seleccione un area");
	jQuery.validator.addMethod('selectCodigoPDI', function (value) {
		return (value != '0');
	}, "Seleccione el codigo pdi");
	jQuery.validator.addMethod('selectTipoAccion', function (value) {
		return (value != '0');
	}, "Seleccione una accion");
	jQuery.validator.addMethod('selectLineaEquipo', function (value) {
		return (value != '0');
	}, "Seleccione una linea de equipo");
	jQuery.validator.addMethod('selectSublineaEquipo', function (value) {
		return (value != '0');
	}, "Seleccione una sublinea de equipo");
	jQuery.validator.addMethod('selectEquipo', function (value) {
		return (value != '0');
	}, "Seleccione un equipo");
	jQuery.validator.addMethod('selectCaracteristicas', function (value) {
		return (value != '0');
	}, "Seleccione una Caracteristica");

}

