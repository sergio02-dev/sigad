function validar_poai(){
	
	$("#poaiform").validate({
		rules: {
			selAccion:{
				selectAccion: true,
			},
			selFuenteFinanciacion:{
				selectFuenteFinanciacion : true,
			},
			selVigencia:{
				selectVigencia: true,
			},
            selSede:{
                selectSede: true,
            },
			selIndicador:{
				selectIndicador: true,
			},
            txtSaldo:{
                required: true,
            },
			selAcuerdo:{
				selectAcuerdo: true,
			},
            chkestado:{
                required: true,
            }
		},

		messages:{
            txtSaldo:{
                required: "Ingrese el Saldo",
            },
            chkestado:{
                required: "Seleccione una Opción",
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
			var url_proceso = $('#url').val();
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
					//window.location.href = 'ppi?'+codigo_plan+'-'+codigo_ppi;
                }
            });
            return false; 
		}
	});

    jQuery.validator.addMethod('selectAccion', function (value) {
		return (value != '0');
	}, "Seleccione una Opción");
	
	jQuery.validator.addMethod('selectVigencia', function (value) {
		return (value != '0');
	}, "Seleccione una Opción");
	
	jQuery.validator.addMethod('selectFuenteFinanciacion', function (value) {
		return (value != '0');
	}, "Seleccione la Fuente de Financiación");
    
    jQuery.validator.addMethod('selectSede', function (value) {
		return (value != '0');
	}, "Seleccione la Sede");
	
	jQuery.validator.addMethod('selectIndicador', function (value) {
		return (value != '0');
	}, "Seleccione un Indicador");
	
	jQuery.validator.addMethod('selectAcuerdo', function (value) {
		return (value != '0');
	}, "Seleccione el Acto Administrativo");
}