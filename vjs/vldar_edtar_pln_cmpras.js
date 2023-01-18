function validar_plancompras(){
	
	var plancompras = new Array();

		//Inicio Validación actividades
		plancompras = $('[name="plancompras[]"]:checked').map(function () {
			return this.value;
		}).get();

		 
		cantidad_plancompra = plancompras.length;

		if(cantidad_plancompra == 0){
		$('#error_plancompras').html('Seleccione al menos un plan de compras');
		return false;
		}
		

	$("#editarplancompraform").validate({
		
	
		submitHandler: function(form){
			var code_acccion=$('#codigo_accion').val();
			var code_poai=$('#codigo_poai').val();
			var codigo_formulario = $('#codigo_formulario').val();
			var url_proceso = $('#url').val();
			//alert(url_proceso);

			$.ajax({
				type: "POST",
				url: url_proceso,
				data: $(form).serialize(),
				success: function (data, status) {
                    $('#frmModalEtapaEditar'+codigo_formulario+code_poai).modal('hide');
					$('#frmModalEtapaEditar'+codigo_formulario+code_poai).modal({backdrop: false});

                    $('#registroActividad'+code_acccion).load("datainfoaccion?codigo_accion="+code_acccion);
					$('.modal-backdrop').remove();
					
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


}
	