function validar_oficinafuente(){
	
	$("#oficinafuentefrm").validate({
		rules: {
            selOficina:{
                required: true,
            },
            selCargo:{
                required: true,
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