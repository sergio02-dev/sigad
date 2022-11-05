function validar_eliminar_etapa(){
    var data_enviar=$('#eliminaretapaform').serialize();    
     
    var code_acccion=$('#codigo_accion').val();
    //alert(code_acccion);

    $.ajax({
        type: "POST",
        url: 'crudeliminaretapa',
        data: data_enviar,
        success: function (data, status) {
            // ajax done
            // do whatever & close the modal                                    
            $('#frmModal').modal('hide');
            $('#tabla_poai'+code_acccion).load("datainfoaccion?accion_codee="+code_acccion);
                            
        }
    });
}



