<script src="vjs/lmnarTpa.js"></script>
<?php
    include('grlla/data/tpoctvdad.php');


    $codigo_etapa=$_REQUEST['codigo_etapa'];
    $codigo_accion=$_REQUEST['codigo_accion'];
    $referencia=$_REQUEST['referencia'];

    
   
//echo "--> ".$codigo_actividad;
?>
<form id="eliminaretapaform" role="form" method="post">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong>ELIMINA ETAPA <?php echo strtoupper($referencia); ?></strong> </h4>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <p class="font-weight-bold">¿Esta seguro que desea elimiar la Etapa <?php echo $referencia; ?>?</p>
    

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_etapa" id="codigo_etapa" value="<?php echo $codigo_etapa; ?>">
        <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <!--<button type="submit" class="btn btn-danger" onClick="validar_eliminar_etapa();"><i class="far fa-save"></i> Eliminar</button>-->
        <button type="button" class="btn btn-danger" onClick="validar_eliminar_etapa();"><i class="far fa-save"></i> Eliminar</button>
    </div>
</form>
