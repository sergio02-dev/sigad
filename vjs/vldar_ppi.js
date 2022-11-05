function validar_ppi(){
	
	$("#ppiform").validate({
		rules: {
			selTipoFuenteFinanciacion:{
				selectTipoFuenteFinanciacion: true,
			},
			selFuenteFinanciacion:{
				selectFuenteFinanciacion : true,
			}
		},

		messages:{
		
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
			var url_proceso = $('#url').val();
			var codigo_plan = $('#codigo_plan').val();
			var codigo_ppi = $('#codigo_ppi').val();
		
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					window.location.href = 'ppi?'+codigo_plan+'-'+codigo_ppi;
                }
            });
			
            return false; 
		
		}
	});

	
	jQuery.validator.addMethod('selectFuenteFinanciacion', function (value) {
		return (value != '0');
	}, "Seleccione la Fuente de Financiación");
	
	jQuery.validator.addMethod('selectTipoFuenteFinanciacion', function (value) {
		return (value != '0');
	}, "Seleccione el Tipo de Fuente de Financiación");
	
}