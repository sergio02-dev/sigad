function validar_formpdi(){
	

	$("#plancomprasPDIform").validate({
		rules: {
        	inputPlantaFisica:{
				required: function(element){
					return $('#plantaFisica').val() == 1;
				},
				minlength:3,
				
            },
			selCantidad:{
				required: true,
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
				selectLineaEquipo:  function(element){
					return $('#plantaFisica').val() == 0;
				}
			},
			selSublineaEquipo:{
				selectSublineaEquipo:   function(element){
					return $('#plantaFisica').val() == 0;
				}
			},
			selEquipo:{
				selectEquipo:  function(element){
					return $('#plantaFisica').val() == 0;
				}
			},
			selCaracteristicas:{
				selectCaracteristicas:   function(element){
					return $('#plantaFisica').val() == 0;
				}
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
					plancomprasPDIform.reset();
					$(capa_direccion).load(url_direccion);
					plancomprasPDIform.reset();
						$('#selSede').selectpicker('val', '0');
						$('#selTipoVicerrectoria').selectpicker('val', '0');
						$('#selTipoFacultad').selectpicker('val', '0');
						$('#selDependencia').selectpicker('val', '0');
						$('#selArea').selectpicker('val', '0');
						$('#selLineaEquipo').selectpicker('val', '0');
						$('#selSublineaEquipo').selectpicker('val', '0');
						$('#selEquipo').selectpicker('val', '0');
						$('#selCaracteristicas').selectpicker('val', '0');
						$('#selProyecto').selectpicker('val', '0');			
						$('#selAccion').selectpicker('val', '0');		
					
					swal({
						title: "Registro Exitoso",
						text: "",
						icon: "success",
						button: "OK",
			
					  });
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

