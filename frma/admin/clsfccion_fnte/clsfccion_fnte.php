<?php
    include('crud/rs/admin/clsfccion_fnte/clsfccion_fnte.php');

    $codigo_clasificacion_fuente = $_REQUEST['codigo_clasificacion_fuente'];
   
    if($codigo_clasificacion_fuente){

       $clasificacion_fuente_form = $objClasificacionFuente->form_clsfccion_fuente($codigo_clasificacion_fuente);

        foreach($clasificacion_fuente_form as $data_frm_clasificacion_fuente){
            $cla_codigo = $data_frm_clasificacion_fuente['cla_codigo'];
            $cla_nombre = $data_frm_clasificacion_fuente['cla_nombre'];
            $cla_descripcion = $data_frm_clasificacion_fuente['cla_descripcion'];
            $cla_estado = $data_frm_clasificacion_fuente['cla_estado'];
        }

        if($cla_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }

        if($cla_estado == 0){
            $checkedA = "";
            $checkedI = "checked";
        }

        $url_guardar="modfcarclasificacionfuentefinanciacion";
        $task = "MODIFICACI&Oacute;N";
    }
    else{
        $url_guardar="regstroclaficacionfuentefinanciacion";
        $task = "REGISTRO";
        $checkedA = "checked";
        $checkedI = "";
    }

?>
<form id="clasificacionfuenteform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> CLASIFICACIÓN PRESUPUESTO FUENTES DE FINANCIACI&Oacute;N</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $cla_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtDescripcion" class="font-weight-bold"> Descripci&oacute;n *</label>
                    <textarea class="form-control caja_texto_sizer" name="txtDescripcion" id="txtDescripcion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $cla_descripcion; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="textNumeroVeces" class="font-weight-bold">Estado *</label>
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
        <input type="hidden" name="codigo_clasificacion_fuente" id="codigo_clasificacion_fuente" value="<?php echo $cla_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="botonGuardar" class="btn btn-danger" onClick="validar_clsfccion_fuente();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_clsfccion_fuente.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

