function validar_cierre_ppi(){
	
	$("#closeppiform").validate({
		rules: {

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
					$('.modal-backdrop').remove();

					window.location.href = 'ppi?'+codigo_plan+'-'+codigo_ppi;
                }
            });
			
            return false; 
		
		}
	});

	
	
}