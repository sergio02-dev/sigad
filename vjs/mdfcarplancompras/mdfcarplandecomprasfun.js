function validar_formfun(){
	

	$("#plancomprasfuncionamientoform").validate({
		rules: {
			selCantidad:{
				required: true,
				min: 1,
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
			selLineaEquipo:{
				selectLineaEquipo: true,
			},
			selSublineaEquipo:{
				selectSublineaEquipo:   true,
			},
			selEquipo:{
				selectEquipo:  true,
			},
			selCaracteristicas:{
				selectCaracteristicas:   true,
			}

			

		},

		messages:{
			chkestado:{
				required: "Digite la Descripción",
			},
			selCantidad:{
				required:"Debe digitar este dato",
				min:"Debe digitar un valor mayor a 1",
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

			
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					
					
					
						
					swal({
						title: "Registro Exitoso",
						text: "",
						icon: "success",
						button: "OK",
			
					  });
					setTimeout(function() {
						window.location.href = "consultafun";
					}, 2000);


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

