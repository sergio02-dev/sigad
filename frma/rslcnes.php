<?php
    include('crud/rs/rslcnes.php');

    $codigo_resolucion=$_REQUEST['codigo_resolucion'];

    $list_acuerdos = $objResolucion->list_acuerdos();
   
    if($codigo_resolucion){

       $resolucion_form = $objResolucion->form_resolucion($codigo_resolucion);

        foreach($resolucion_form as $data_frm_resolucion){
            $aad_codigo = $data_frm_resolucion['aad_codigo'];
            $add_nombre = $data_frm_resolucion['add_nombre'];
            $add_vigencia = $data_frm_resolucion['add_vigencia'];
            $add_urlactoadmin = $data_frm_resolucion['add_urlactoadmin'];
            $add_padre = $data_frm_resolucion['add_padre'];
            $add_descripcion = $data_frm_resolucion['add_descripcion'];
        }


        $anio_inicio = $add_vigencia;
        $anio_fin = $anio_inicio + 1;

        $url_guardar="modificarresolucion";
        $task = "MODIFICACI&Oacute;N";
    }
    else{
        $url_guardar="registroresolucion";
        $task = "REGISTRO";
        $anio_inicio = date("Y") - 2; 
        $anio_fin = $anio_inicio + 3;
    }

?>
<form id="resolucionform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> RESOLUCI&Oacute;N</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtVigencia" class="font-weight-bold">Año *</label>
                    <select name="txtVigencia" id="txtVigencia"  class="form-control caja_texto_sizer" data-rule-required="true" required >
                        <?php
                            for ($vigencias = $anio_inicio; $vigencias <= $anio_fin; $vigencias++) { 
                                $anios = $vigencias;
                        
                                if($anios == $add_vigencia){
                                    $selected_vigncia = "selected";
                                }
                                else{
                                    $selected_vigncia = "";
                                }
                        ?>
                            <option value="<?php echo  $anios; ?>" <?php echo $selected_vigncia; ?> ><?php echo $anios; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="selAcuerdo" class="font-weight-bold">Acuerdo </label>
                    <select name="selAcuerdo" id="selAcuerdo"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" <?php echo $disabled; ?> >
                    <option value="0"> Seleccione ...</option>
                        <?php
                            foreach ($list_acuerdos as $dta_list_acuerdos) {
                                $aaad_codigo = $dta_list_acuerdos['aad_codigo'];
                                $aadd_nombre = $dta_list_acuerdos['add_nombre'];
                                $aadd_tipoactoadmin = $dta_list_acuerdos['add_tipoactoadmin'];
                        
                                if($add_padre == $aaad_codigo){
                                    $selected_daddy = "selected";
                                }
                                else{
                                    $selected_daddy = "";
                                }
                        ?>
                            <option value="<?php echo  $aaad_codigo; ?>" <?php echo $selected_daddy; ?> ><?php echo substr($aadd_nombre,0,88); ?> ...</option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtNombre" class="font-weight-bold">Nombre *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNombre" name="txtNombre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $add_nombre; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="txtDescripcion" class="font-weight-bold"> Descripci&oacute;n *</label>
                    <textarea class="form-control caja_texto_sizer" name="txtDescripcion" id="txtDescripcion" aria-describedby="textHelp" data-rule-required="true"  required><?php echo $add_descripcion; ?></textarea>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtUrl" class="font-weight-bold">Url Documento *</label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtUrl" name="txtUrl" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $add_urlactoadmin; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        

        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigo_resolucion" id="codigo_resolucion" value="<?php echo $codigo_resolucion; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_resolucion();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_resolucion.js"></script>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>
