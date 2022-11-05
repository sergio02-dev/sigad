/**
 * Karen Yuliana Palacio Minú
 * Validacion Registro Actividad
 * 27 de Mayo 2021 01.13pm
 */
 function validar_reporte(){
	
	$("#rprteActvdad").validate({
		rules: {
			selActoAdministrativo:{
				selectActoAdministrativo: true,
			},
			txtNumeroAcuerso:{
				required: true,
				minlength:1,
			},
			txtTituloNombre:{
				required: true,
				minlength:1,
			},
            txtLogro:{
				required: true,
				minlength:1,
			},
			
		},

		messages:{
			txtNumeroAcuerso:{
				required: "Digite el número de Acuerdo o Resolución",
                minlength:"Debe ser mayor a 1 Caracter",
			},
			txtTituloNombre:{
				required: "Digite el Título / Nombre ",
                minlength:"Debe ser mayor a 1 Caracter",
			},
            txtLogro:{
				required: "Digite el Logro ",
                minlength:"Debe ser mayor a 1 Caracter",
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
			
			var url_proceso = $('#url_proceso').val();
			var capa_direccion = $('#capa_direccion').val();
			var url_direccion = $('#url_direccion').val();
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
                    $('#frmModal').modal('hide');
					$(capa_direccion).load(url_direccion);   
                }
            });
			
            return false; 
		
		}
	});

	jQuery.validator.addMethod('selectActoAdministrativo', function (value) {
			return (value != '0');
		}, "Seleccione el Acto Administrativo");
	

			
	
}

