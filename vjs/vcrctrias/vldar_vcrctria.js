function validar_vicerrectoria(){
	
	$("#vicerrectoriafrm").validate({
		rules: {
            txtNombre:{
                required: true,
				minlength:3,
            },
			chkestado:{
				required: true,
			},

		},

		messages:{
			txtNombre:{
                required: "Digite el Nombre",
                minlength:"Debe ser mayor a 3 caracteres",
			},
			chkestado:{
				required: "Digite la Descripción",
			},
		},
		submitHandler: function(form){
			var url_proceso=$('#url').val();
            var capa_direccion = $('#capa_direccion').val();
            var url_direccion = $('#url_direccion').val();
			
			$.ajax({
                type: "POST",
                url: url_proceso,
                data: $(form).serialize(),
                success: function (data, status) {
					$('#frmModal').modal('hide');
					$(capa_direccion).load(url_direccion);
                    $('.modal-backdrop').remove();
                }
            });
			
            return false; 
		
		}
	});

}