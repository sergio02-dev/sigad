<?php

   $codigo_poai = $_REQUEST['codigo_poai'];
   $codigo_accion = $_REQUEST['codigo_accion'];   
  
   
   include('crud/rs/pln_cmpras/pln_cmpras.php');

  

   $datos_etapa = $objPlanCompras->datos_etapa($codigo_poai);

    $url_guardar="registroplancompras";
    $codigo_formulario = $codigo_poai;
    $tarea = "AGREGAR";
    $checkedA="checked";
    $checkedI="";
    $valor_uni = 0;
    $cantidad = 0;
?>
<style>
    .fuente_input_tabla{
        font-size: 12px;
    }

    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

</style>
<form id="editarplancompraform" role="form">
    <div class="modal-header fondo-titulo">
        <h3 class="modal-title"><strong><?php echo $tarea; ?> PLAN DE COMPRAS</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-md-12">
                <p style="font-size: 113%;"><?php echo $datos_etapa; ?></p>
                
                
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtDescripcion" class="font-weight-bold">Descripci&oacute;n *</label>
                    <textarea class="form-control caja_texto_sizer" rows="4" name="txtDescripcion" id="txtDescripcion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $poa_objeto; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txtCantidad" class="font-weight-bold">Cantidad *</label>
                    <input type="number" class="form-control caja_texto_sizer sma" id="txtCantidad" name="txtCantidad" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $cantidad;?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txtValorUnitario" class="font-weight-bold">Valor Unitario *</label>
                    <input type="text" class="form-control caja_texto_sizer sma" id="txtValorUnitario" name="txtValorUnitario" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $valor_uni; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txtValorTotal" class="font-weight-bold">Valor Total *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtValorTotal" name="txtValorTotal" aria-describedby="textHelp" data-rule-required="false" value="<?php echo $poa_logroejecutado; ?>" readonly>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

    <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="num_datos" id="num_datos" value="<?php echo $num_datos; ?>">
        <input type="hidden" name="codigo_formulario" id="codigo_formulario" value="<?php echo $codigo_formulario; ?>">
        <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
        <input type="hidden" name="codigo_poai" id="codigo_poai" value="<?php echo $codigo_poai; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php
            if($num_datos>0){
        ?>
        <button type="submit" class="btn btn-danger" onClick="validar_plancompras();"><i class="far fa-save"></i> Guardar</button>
        <?php
            }
        ?>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_edtar_pln_cmpras.js"></script>

