function validar_actoAdministrativo(){
	//alert('Hola');
	$("#actoadministrativoform").validate({
		rules: {
            txtNombre:{
                required: true,
				minlength:3,
            },
			selTipoActo:{
                selectTipoActo: true,
				//minlength:3,
			},


			
			txtUrl:{
				required: true,
			},
			/*selAcuerdo:{
				selectedAcuerdo: function(element){
					return $('input:radio[name=chktipoacto]:checked').val() == '2';
				},
			},*/
			txtDescripcion:{
				required: true,
			}
			
		},

		messages:{
			txtNombre:{
                required: "Digite el Nombre",
                minlength:"Debe ser mayor a 3 letras",
			},
			selTipoActo:{
                required: "Seleccione un Tipo de Acto",
               // minlength:"Debe ser mayor a 3 letras",
			},
			
			txtUrl:{
				required: "Ingrese la Url del documento",
			},
			txtDescripcion:{
				required: "Ingrese una Descripción",
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
			//alert(url_proceso);
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					$('.modal-backdrop').remove();
					
					$("#tablaActoAdministrativo").load("dataactoadministrativo");
                }
            });
			
            return false; 
		
		}
	});


	jQuery.validator.addMethod('selectTipoActo', function (value) {
			return (value != '0');
		}, "Seleccione un Tipo de Acto");

	/*jQuery.validator.addMethod('selectedAcuerdo', function (value) {
			return (value != '0');
		}, "Seleccione un Acuerdo");	*/
}

