function validar_certificado(){
    var data_enviar=$('#eliminarCertificadoForm').serialize();    
     
    $.ajax({
        type: "POST",
        url: "crudeliminarcertificado",
        data: data_enviar,
        success: function (data,status) {
            // (data,status)
            // ajax done
            // do whatever & close the modal
            $('#frmModal').modal('hide');
            
            $("#tablaCertificados").load("datacertificados");
            //("registroactividadrecargar?codigo_actividad="+codigo_actividad+"&accion_actividad="+accion_actividad+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion);
        }
    });
}



