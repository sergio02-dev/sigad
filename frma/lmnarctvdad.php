<script src="vjs/eliminarRegistroActividad.js"></script>
<?php
    include('grlla/data/tpoctvdad.php');


    $codigo_activida_realizada=$_REQUEST['codigo_activida_realizada'];
    $codigo_actividad=$_REQUEST['codigo_actividad'];
    $codigo_accion=$_REQUEST['codigo_accion'];

    
   
//echo "--> ".$codigo_actividad;
?>
<form id="eliminaractividadform" role="form" method="post">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong>ELIMINAR ACTIVIDAD</strong></h4>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <p class="font-weight-bold">¿Esta seguro que desea elimiar el registro?</p>
    

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigoActividadRealizada" id="codigoActividadRealizada" value="<?php echo $codigo_activida_realizada; ?>">
        <input type="hidden" name="codigo_actividad" id="codigo_actividad" value="<?php echo $codigo_actividad; ?>">
        <input type="hidden" name="accion_actividad" id="accion_actividad" value="<?php echo $accion_actividad; ?>">
        <input type="hidden" name="acc_descripcion" id="acc_descripcion" value="<?php echo $acc_descripcion; ?>">
        <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <!--<button type="submit" class="btn btn-danger" onClick="validar_eliminar_actividad();"><i class="far fa-save"></i> Eliminar</button>-->
        <button type="button" class="btn btn-danger" onClick="validar_eliminar_actividad();"><i class="far fa-save"></i> Eliminar</button>
    </div>
</form>
