function validar_formActividadPoai(){
//alert('Hola');
	$("#actividaPoaiform").validate({
		rules: {
			selActividad:{
				required: true,
				minlength:3,
			},
			fechaExpedicion:{
				required: true,
			},
			dependenciaActividad:{
				selectDependencia: true,
			},
			trimestreActividad:{
				selectTrimestre: true,
			},
			vigenciaActividad:{
				selectVigencia: true,
			},
			textValor:{
				required: true,
			},
			chkestado:{
				required: true,
			}
		},

		messages:{
			selActividad:{
                required: "Digite la Descripción/Actividad",
                minlength:"Debe ser mayor a 3 letras",
			},
			fechaExpedicion:{
                required: "Ingrese  la Fecha de Expedición",
			},
			textValor:{
                required: "Ingrese el Valor",
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
			var code_acccion=$('#code_accion').val();


			/////////////////////////////////////////

			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {



							$('#frmModal').modal('hide');
							$('.modal-backdrop').remove();
							$('#tabla_poai'+code_acccion).load("recargarpoai?accion_code="+code_acccion);


                }
            });

            return false;

		}
	});


	jQuery.validator.addMethod('selectDependencia', function (value) {
														return (value != '0');
													}, "Seleccione la Dependencia");

	jQuery.validator.addMethod('selectTrimestre', function (value) {
															return (value != '0');
														}, "Seleccione el Trimestre");

	jQuery.validator.addMethod('selectVigencia', function (value) {
														return (value != '0');
													}, "Seleccione la Vigencia");
}
