function validar_encargado(){
    var data_enviar=$('#formencargado').serialize();    
     
    var codigo_accion=$('#codigo_accion').val();
    //alert(code_acccion);

    $.ajax({
        type: "POST",
        url: 'crudregistroencargado',
        data: data_enviar,
        success: function (data, status) {
            // ajax done
            // do whatever & close the modal                                    
            $('#frmModal').modal('hide');
            $('.modal-backdrop').remove();

            $('#rgsrtoEncargadoAccion'+codigo_accion).load("infoencargado?codigo_accion="+codigo_accion);
                            
        }
    });
}



