<?php
    $referencia_etapa = $_REQUEST['referencia_etapa'];
    $codigo_form = $_REQUEST['codigo_poai'];
    $codigo_capa = $_REQUEST['codigo_accion']; 
    $tarea = "REGISTRAR";
?>
<form id="plancompraform" role="form">
    <div class="modal-header fondo-titulo">
        <h3 class="modal-title"><strong> RECURSOS ETAPA <?php echo $referencia_etapa; ?></strong></h3>
        <button type="button" class="close" onclick="cerrar_modal('<?php echo $codigo_form; ?>','<?php echo $codigo_capa; ?>');" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body lista_asignacion">
        <?php
            include('frma/asgncion_rcrsos/view_asignacion.php');
        ?>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_formulario" id="codigo_formulario" value="<?php echo $codigo_formulario; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-danger" onclick="cerrar_modal('<?php echo $codigo_form; ?>','<?php echo $codigo_capa; ?>');"><i class="fas fa-window-close"></i> Cerrar</button>
    </div>
</form>
<script type="text/javascript">
    function cerrar_modal(codigo_form, codigo_capa){
        var codigo_form = codigo_form;
        var codigo_capa = codigo_capa;
        $('#frmModalEtapaEditar'+codigo_form).modal('hide');
        $('#frmModalEtapaEditar'+codigo_form).modal({backdrop: false});

        //$('.modal-backdrop').remove();
        $('#registroActividad'+codigo_capa).load("datainfoaccion?codigo_accion="+codigo_capa);
    }
  
</script>
