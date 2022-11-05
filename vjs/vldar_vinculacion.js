/**
 * 25 de junio de 2019
 * validación formulario persona 
 * TDI AMC
 * */

 function validar_vinculacion(){

	$("#vinculacionform").validate({
		rules: {
			selOficina:{
				selectOficina: true,
			}, 
			selCargo:{
				selectCargo: true,
			}, 
			chkestado:{
				required: true,
			}
		},

		messages:{
			chkestado:{
				required: "Seleccione el Estado",
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
			
			var url_proceso = $('#url_proceso').val();
            var url_direccion = $('#url_direccion').val();
            var capa_direccion = $('#capa_direccion').val();
			//document.getElementById('botonGuardar').disabled=true;

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

	jQuery.validator.addMethod('selectOficina', function (value) {
		return (value != '0');
	}, "Seleccione La Oficina");
    
    jQuery.validator.addMethod('selectCargo', function (value) {
		return (value != '0');
	}, "Seleccione el Cargo");

}