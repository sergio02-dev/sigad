<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('crud/rs/resolucionpersona/resolucionpersona.php');
    $codigo_persona = $_REQUEST['codigo_persona'];
    $codigo_resolucion = $_REQUEST['codigo_resolucion'];
   
    if($codigo_resolucion){
        $url_guardar="modificarresolucionpersona";
        $task = "MODIFICAR RESOLUCION PERSONA";

        
        $form_resolucion_persona = $objResolucionpersona->form_resolucion_persona($codigo_resolucion);

       
        foreach ($form_resolucion_persona as $dta_lsta_resolucion) {
            $rep_codigo = $dta_lsta_resolucion['codigo_resolucion'];
            $rep_resolucion = $dta_lsta_resolucion['rep_resolucion'];
            $rep_fecharesolucion = $dta_lsta_resolucion['rep_fecharesolucion'];
            $rep_estado = $dta_lsta_resolucion['rep_estado'];

            if($rep_estado == 1){
                $checkedA = "checked";
                $checkedI = "";
            }
            else{
                $checkedA = "";
                $checkedI = "checked";
            }
        }
        
    }
    else{
        $url_guardar="registroresolucionpersona";
        $task = "REGISTRAR RESOLUCION PERSONA";
        $checkedA = "checked";
        $checkedI = "";
    }

    $url_direccion = "infoprsona?codigo_persona=".$codigo_persona;
    $capa_direccion = "#infoPersona".$codigo_persona;
    
?>
<form id="resolucionpersona" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNumero" class="font-weight-bold">N&uacute;mero de resoluci&oacute;n *</label>
                    <input type="textNumero" class="form-control caja_texto_sizer" id="txtNumero" name="txtNumero" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $rep_resolucion; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtFecha" class="font-weight-bold">Fecha resoluci&oacute;n *</label>
                    <input type="date" class="form-control caja_texto_sizer" id="txtFecha" name="txtFecha" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $rep_fecharesolucion; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        <div class="row">  
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtEstado" class="font-weight-bold">Estado *</label>
                    <div class="radio tipo1">
                        <input type="radio"   id="ractivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="1" <?php echo $checkedA; ?> required/>
                        <label for="ractivo"><span></span> Activo</label>

                        <input type="radio"   id="rinactivo" name="chkestado"  aria-describedby="textHelp" data-rule-required="true" value="0" <?php echo $checkedI; ?> required />
                        <label for="rinactivo"><span></span> Inactivo</label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="codigo_persona" id="codigo_persona" value="<?php echo $codigo_persona; ?>">
        <input type="hidden" name="codigo_resolucion" id="codigo_resolucion" value="<?php echo $codigo_resolucion; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onclick="validar_resolucionpersona();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/resolucionpersona/vldar_resolucionpersona.js"></script>

