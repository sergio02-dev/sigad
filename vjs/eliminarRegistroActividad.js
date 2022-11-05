function validar_eliminar_actividad(){
    var data_enviar=$('#eliminaractividadform').serialize();
    var codigoActividadRealizada=$('#codigoActividadRealizada').val();
    var codigo_actividad=$('#codigo_actividad').val();
    var accion_actividad=$('#accion_actividad').val();
    var acc_descripcion=$('#acc_descripcion').val();
    var codigo_accion=$('#codigo_accion').val();
    //alert(codigo_actividad);
    
     
    $.ajax({
        type: "POST",
        url: "crudeliminaractividad",
        data: data_enviar,
        success: function (data,status) {
            // (data,status)
            // ajax done
            // do whatever & close the modal
            $('#frmModalEliminar').modal('hide');
            $('.modal-backdrop').remove();

            $("#tabla_actividadRealizada"+codigo_actividad).load("registroactividadrecargar?codigo_actividad="+codigo_actividad+"&codigo_accion="+codigo_accion);
            //("registroactividadrecargar?codigo_actividad="+codigo_actividad+"&accion_actividad="+accion_actividad+"&acc_descripcion="+acc_descripcion+"&codigo_accion="+codigo_accion);
        }
    });
    //var data_enviar=$('#formmiscursos').serialize();
    /*   $.post("crudeliminaractividad", data_enviar,
        function(data_enviar, status){
        //alert();
            $('#frmModalEliminar').modal('hide');
            $("#tabla_actividadRealizada"+codigo_actividad).load("registroactividadrecargar?"+codigo_actividad);

            // cerrar_modal(aleatoriomodal);


        });*/
}



