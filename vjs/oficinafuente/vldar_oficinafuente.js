function validar_oficinafuente(){

    var selOficina = $('#selOficina').val();
    var chkestado = $('input:radio[name=chkestado]:checked').val();
    var selCargo = $('#selCargo').val();
    var fuente = new Array();

        if(selOficina == 0){
            $("#error_oficina").fadeIn('300');
            $("#error_oficina").html('Seleccione una Opcion');
            document.getElementById("selOficina").focus();
            return false;
        }
        else{
            $("#error_oficina").fadeOut('300');
        }	

        if(selCargo == 0){
            $("#error_cargo").fadeIn('300');
            $("#error_cargo").html('Seleccione una Opcion');
            document.getElementById("selCargo").focus();
            return false;
        }
        else{
            $("#error_cargo").fadeOut('300');
        }	

        if(!chkestado){
            $("#error_estado").fadeIn('300');
            $("#error_estado").html('Seleccione una Opcion');
            document.getElementById("ractivo").focus();
            return false;
        }
        else{
            $("#error_estado").fadeOut('300');
        }

        //Inicio Validación actividades
        fuente = $('[name="fuente[]"]:checked').map(function () {
            return this.value;
        }).get();

        cantidad_fuentes = fuente.length;

        if(cantidad_fuentes == 0){
        $('#error_fuente').html('Seleccione al menos una Actividad');
        return false;
        }
        else{
        $('#error_fuente').html('');
        }

	
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