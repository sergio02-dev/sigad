function validar_eliminar_actividad(){
    var data_enviar=$('#eliminaractividadform').serialize();    
     
    var code_acccion=$('#codigo_accion').val();
    //alert(code_acccion);

    $.ajax({
        type: "POST",
        url: 'eliminaractividadaccion',
        data: data_enviar,
        success: function (data, status) {
            // ajax done
            // do whatever & close the modal                                    
            $('#frmModal').modal('hide');
            $('.modal-backdrop').remove();

            $('#tabla_poai'+code_acccion).load("datainfoaccion?accion_codee="+code_acccion);
                            
        }
    });
}



