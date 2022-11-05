<?php
    include('crud/rs/admin/tpo_fnte/tpo_fnte.php');

    $codigo_tipo_fuente = $_REQUEST['codigo_tipo_fuente'];
   
    if($codigo_tipo_fuente){

       $tipo_fuente_form = $objTipoFuente->form_tipo_fuente($codigo_tipo_fuente);

        foreach($tipo_fuente_form as $data_frm_tipo_fuente){
            $tff_codigo = $data_frm_tipo_fuente['tff_codigo'];
            $tff_nombre = $data_frm_tipo_fuente['tff_nombre'];
            $tff_estado = $data_frm_tipo_fuente['tff_estado'];
            $tff_descripcion = $data_frm_tipo_fuente['tff_descripcion'];
        }

        if($tff_estado == 1){
            $checkedA = "checked";
            $checkedI = "";
        }

        if($tff_estado == 0){
            $checkedA = "";
            $checkedI = "checked";
        }

        $url_guardar="modificartipofuentefinanciacion";
        $task = "MODIFICACI&Oacute;N";
    }
    else{
        $url_guardar="registrotipofuentefinanciacion";
        $task = "REGISTRO";
        $checkedA = "checked";
        $checkedI = "";
    }

?>
<form id="tipofuenteform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> GRUPO FUENTES DE FINANCIACI&Oacute;N</strong></h4>

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
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $tff_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtDescripcion" class="font-weight-bold"> Descripci&oacute;n *</label>
                    <textarea class="form-control caja_texto_sizer" name="txtDescripcion" id="txtDescripcion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $tff_descripcion; ?></textarea>
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
        <input type="hidden" name="codigo_tipo_fuente" id="codigo_tipo_fuente" value="<?php echo $tff_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="botonGuardar"  class="btn btn-danger" onClick="validar_tipo_fuente();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_tpo_fuente.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

