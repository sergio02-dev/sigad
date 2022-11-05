function validar_formActividad(){
	
	var maximo_admitido = parseInt($('#summaa').val());
	var txtOtroValor = parseInt($('#txtOtroValor').val());
	
	$("#formcertificados").validate({
		rules: {
			fechaExpedicion:{
				required: true,
			},
			selResolucion:{
				selectResolucion: function(element){
					return $('#estadoActividad').val() == 1;
				},
			},
			selPlanDesarrollo:{
				selectPlanDesarrollo: true,
			},
			selActividad:{
				required: true,	
			},
			selSubsistema:{
				selectSubsistema: function(element){
					return $('#estadoActividad').val() == 1;
				},
			},
			selProyecto:{
				selectProyecto: function(element){
					return $('#estadoActividad').val() == 1;
				},
			},
			selAccion:{
				selectAccion: function(element){
					return $('#estadoActividad').val() == 1;
				},
			},
			selAccionList:{
				selectAccionPlan: function(element){
					return $('#estadoActividad').val() == 2;
				},
			},
			selCertificadoModificar:{
				selectCertificadoModificar: function(element){
					return $('#estadoActividad').val() == 2;
				},
			},
			textCertificado:{
				required: true,
			},
			trimestreActividad:{
				selecttrimestreActividad: true,
			},
			vigenciaActividad:{
				selectvigenciaActividad: true,
			},
			estadoActividad:{
				selectEstado: true,
			},
			textValor:{
				required: true,
			},
			act_certificadomod:{
				required: true,
			},
			'actvddes[]':{
				required: function(element){
					return $('#selPlanDesarrollo').val() != '1';
				},
			},
			'etpass[]':{
				required: function(element){
					return $('#selPlanDesarrollo').val() != '1';
				},
			}, 
			txtOtroValor:{
				required: function(element){
					return $('input:checkbox[name=checkedOtroValor]:checked').val() == 1;
				},
				min:{
					param: 0,
					depends: function (element) {
						return $('input:checkbox[name=checkedOtroValor]:checked').val() == 1;
					},
				},
				max:{
					param: maximo_admitido,
					depends: function (element) {
						return $('input:checkbox[name=checkedOtroValor]:checked').val() == 1;
					},
				}
			},

		
		},

		messages:{

		 	textValor:{
				required: "Digite el valor",
				//minlength:"Debe ser mayor a 3 letras",
			},
			fechaExpedicion:{
				required: "Digite la Fecha de Expedición",
				//minlength:"Debe ser mayor a 3 letras",
			},
			textCertificado:{
				required: "Digite el Certificado",
			},
			act_certificadomod:{
				required: "Digite el Certificado",
			},
			'actvddes[]':{
				required: "Debe Seleccionar una opción", 
			},
			'etpass[]':{
				required: "Debe Seleccionar una opción", 
			},
			txtOtroValor:{
				required: "El campo no puede ir vació",
				min: "Debe ser menor a 0",
				max: "El valor debe no puede ser mayor a $"+$('#SumTotal').val(),
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

					$('#tablaCertificados').load("datacertificados");
                }
            });

            return false;

		}
	});

	
	jQuery.validator.addMethod('selectResolucion', function (value) {
		return (value != '0');
	}, "Seleccione la Resolución");
	
	jQuery.validator.addMethod('selectPlanDesarrollo', function (value) {
		return (value != '0');
	}, "Seleccione el Plan de Desarrollo");

	jQuery.validator.addMethod('selectSubsistema', function (value) {
		return (value != '0');
	}, "Seleccione el Subsistema");

	jQuery.validator.addMethod('selectProyecto', function (value) {
		return (value != '0');
	}, "Seleccione el Proyecto");

	jQuery.validator.addMethod('selectAccion', function (value) {
		return (value != '0');
	}, "Seleccione la Acción");

	jQuery.validator.addMethod('selectAccionPlan', function (value) {
		return (value != '0');
	}, "Seleccione la Acción");

	jQuery.validator.addMethod('selectCertificadoModificar', function (value) {
		return (value != '0');
	}, "Seleccione el Certificado");
	
	jQuery.validator.addMethod('selecttrimestreActividad', function (value) {
		return (value != '0');
	}, "Seleccione el Trimestre");

	jQuery.validator.addMethod('selectvigenciaActividad', function (value) {
		return (value != '0');
	}, "Seleccione la Vigencia");

	jQuery.validator.addMethod('selectEstado', function (value) {
		return (value != '0');
	}, "Seleccione el Estado de la Actividad");	

	
				
}
