<?php
    include('crud/rs/admin/fntes_fnnccion/fntes_fnnccion.php');

    $codigo_fuente_financiacion = $_REQUEST['codigo_fuente_financiacion'];

    $list_tipo_fuente = $objFuenteFinanciacion->list_tipo_fuente();

    $clasificacion_fuente = $objFuenteFinanciacion->clasificacion_fuente();

    $clasificacion_planeacion = $objFuenteFinanciacion->clasificacion_planeacion();
   
    if($codigo_fuente_financiacion){

       $fuente_financiacion_form = $objFuenteFinanciacion->form_fuente_financiacion($codigo_fuente_financiacion);

        foreach($fuente_financiacion_form as $data_frm_fuente_financiacion){
            $ffi_codigo = $data_frm_fuente_financiacion['ffi_codigo'];
            $ffi_nombre = $data_frm_fuente_financiacion['ffi_nombre'];
            $ffi_descripcion = $data_frm_fuente_financiacion['ffi_descripcion'];
            $ffi_tipofuente = $data_frm_fuente_financiacion['ffi_tipofuente'];
            $ffi_estado = $data_frm_fuente_financiacion['ffi_estado'];
            $ffi_clasificacion = $data_frm_fuente_financiacion['ffi_clasificacion'];
            $ffi_codigolinix = $data_frm_fuente_financiacion['ffi_codigolinix'];
            $ffi_referencialinix = $data_frm_fuente_financiacion['ffi_referencialinix'];
            $ffi_clasificacionplaneacion = $data_frm_fuente_financiacion['ffi_clasificacionplaneacion'];
        }

        if($ffi_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }

        if($ffi_estado == 0){
            $checkedA = "";
            $checkedI = "checked";
        }

        $url_guardar="modificarfuentesfinanciacion";
        $task = "MODIFICACI&Oacute;N";
    }
    else{
        $url_guardar="registrofuentesfinanciacion";
        $task = "REGISTRO";

        $checkedA = "checked";
        $checkedI = "";
    }

?>
<form id="fuentesfinanciciacion" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> FUENTES DE FINANCIACI&Oacute;N</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selClasificacion" class="font-weight-bold"> Clasificaci&oacute;n Presupuesto*</label>
                    <select name="selClasificacion" id="selClasificacion"  class="form-control caja_texto_sizer selectClasificacion" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                    <option value="0"> Seleccione ...</option>
                        <?php
                            foreach ($clasificacion_fuente as $data_clasificacion_fuente) {
                                $cla_codigo = $data_clasificacion_fuente['cla_codigo'];
                                $cla_nombre = $data_clasificacion_fuente['cla_nombre'];
                                $cla_descripcion = $data_clasificacion_fuente['cla_descripcion'];
                        
                                if($ffi_clasificacion == $cla_codigo){
                                    $select_clasificacion = "selected";
                                }
                                else{
                                    $select_clasificacion = "";
                                }
                        ?>
                            <option value="<?php echo  $cla_codigo; ?>" <?php echo $select_clasificacion; ?> ><?php echo $cla_nombre; ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selClasificacionPlncion" class="font-weight-bold"> Clasificaci&oacute;n Planeaci&oacute;n*</label>
                    <select name="selClasificacionPlncion" id="selClasificacionPlncion"  class="form-control caja_texto_sizer selectPlaneacion" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                    <option value="0"> Seleccione ...</option>
                        <?php
                            foreach ($clasificacion_planeacion as $data_clasificacion_planeacion) {
                                $cpl_codigo = $data_clasificacion_planeacion['cpl_codigo'];
                                $cpl_nombre = $data_clasificacion_planeacion['cpl_nombre'];
                                $cpl_descripcion = $data_clasificacion_planeacion['cpl_descripcion'];
                        
                                if($ffi_clasificacionplaneacion == $cpl_codigo){
                                    $select_clasificacion_plncion = "selected";
                                }
                                else{
                                    $select_clasificacion_plncion = "";
                                }
                        ?>
                            <option value="<?php echo  $cpl_codigo; ?>" <?php echo $select_clasificacion_plncion; ?> ><?php echo $cpl_nombre; ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-11">
                <div class="form-group">
                    <label for="selTipoFuente" class="font-weight-bold">Grupo *</label>
                    <select name="selTipoFuente" id="selTipoFuente"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
                    <option value="0"> Seleccione ...</option>
                        <?php
                            foreach ($list_tipo_fuente as $data_tipo_fuente) {
                                $tff_codigo = $data_tipo_fuente['tff_codigo'];
                                $tff_nombre = $data_tipo_fuente['tff_nombre'];
                                $tff_estado = $data_tipo_fuente['tff_estado'];
                        
                                if($ffi_tipofuente == $tff_codigo){
                                    $select_tipo = "selected";
                                }
                                else{
                                    $select_tipo = "";
                                }
                        ?>
                            <option value="<?php echo  $tff_codigo; ?>" <?php echo $select_tipo; ?> ><?php echo $tff_nombre; ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtCodigoLinix" class="font-weight-bold">C&oacute;digo Linix *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtCodigoLinix" name="txtCodigoLinix" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ffi_codigolinix; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtReferenciaLinix" class="font-weight-bold">Referencia Linix *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtReferenciaLinix" name="txtReferenciaLinix" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ffi_referencialinix; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $ffi_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtDescripcion" class="font-weight-bold"> Descripci&oacute;n *</label>
                    <textarea class="form-control caja_texto_sizer" name="txtDescripcion" id="txtDescripcion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $ffi_descripcion; ?></textarea>
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
        <input type="hidden" name="codigo_fuente" id="codigo_fuente" value="<?php echo $ffi_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="botonGuardar" class="btn btn-danger" onClick="validar_fuente();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_fntes_fnnccion.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectClasificacion').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('.selectPlaneacion').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

