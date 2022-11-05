<script src="vjs/eliminarCertificado.js"></script>
<?php

    $certificado_actividad=$_REQUEST['certificado_actividad'];
    $codigo_actividad=$_REQUEST['codigo_actividad'];

    
?>
<form id="eliminarCertificadoForm" role="form" method="post">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong>ELIMINAR CERTIFICADO</strong></h4>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <p class="font-weight-bold">¿Esta seguro que desea elimiar el certificado <?php echo $certificado_actividad ?>?</p>
    

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_actividad" id="codigo_actividad" value="<?php echo $codigo_actividad; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onClick="validar_certificado();"><i class="far fa-save"></i> Eliminar</button>
    </div>
</form>
