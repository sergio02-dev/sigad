function validar_encargado(){
    var data_enviar=$('#formaccioncargo').serialize();
    //alert(code_acccion);

    $.ajax({
        type: "POST",
        url: 'crudencargadoacciones',
        data: data_enviar,
        success: function (data, status) {
            // ajax done
            // do whatever & close the modal                                    
            $('#frmModal').modal('hide');
            $('.modal-backdrop').remove();

			$("#persona").load("datapersona");                
        }
    });
}



