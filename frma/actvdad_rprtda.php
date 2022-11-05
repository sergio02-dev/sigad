<?php

    include('crud/rs/rprteActvdadPoai.php');

    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigo_reporte = $_REQUEST['codigo_reporte'];

    $descripcion_actividad = $rsReporteActvdadPoai->descripcion_actividad($codigo_actividad);

    $acto_administrativo = $rsReporteActvdadPoai->tipo_acto_admin();
   
    if($codigo_reporte){
        $task = "MODIFICAR";
        $capa_direccion = ".capita-actividad".$codigo_actividad;
        $url_direccion = "infoactivdadreportada?codigo_actividad=".$codigo_actividad."&codigo_accion=".$codigo_accion."&codigo_plan=".$codigo_plan;
        $url_proceso = "crudmodificarreporteactividadpoai";

        $form_reporte_actividad = $rsReporteActvdadPoai->form_reporte_actividad($codigo_reporte);

        foreach($form_reporte_actividad as $data_form_rprte_actvdad){
            $rac_codigo = $data_form_rprte_actvdad['rac_codigo'];
            $rac_codigoactividadpoai = $data_form_rprte_actvdad['rac_codigoactividadpoai'];
            $rac_logro = $data_form_rprte_actvdad['rac_logro'];
            $rac_acto = $data_form_rprte_actvdad['rac_acto'];
            $rac_vigencia = $data_form_rprte_actvdad['rac_vigencia'];
            $rac_numero = $data_form_rprte_actvdad['rac_numero']; 
            $rac_titulo = $data_form_rprte_actvdad['rac_titulo'];        
          
        }     
        
    }
    else{
        $task = "REGISTRAR";
        $capa_direccion = ".acccionactividad".$codigo_accion;
        $url_direccion = "inforegistroactividadplannew?codigo_accion=".$codigo_accion."&codigo_plan=".$codigo_plan;
        
        $url_proceso="crudregistroreporteactividadpoai";

    }

?>
<form id="rprteActvdad" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> REPORTE ACTIVIDAD</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div><strong>Actividad:</strong> <?php echo $descripcion_actividad; ?></div>
        <hr>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="selActoAdministrativo" class="font-weight-bold">Acto Administrativo <strong style="color:#A60D20">*</strong> </label>
                    <select name="selActoAdministrativo" id="selActoAdministrativo"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
                        <option value="0">Seleccione...</option>
                        <?php
                            foreach ($acto_administrativo as $data_acto_administrativo) {

                                $tac_codigo = $data_acto_administrativo['tac_codigo'];
                                $tac_nombre = $data_acto_administrativo['tac_nombre'];

                                if($rac_acto == $tac_codigo){
                                    $selected_tipo_acto="selected";
                                }
                                else{
                                    $selected_tipo_acto="";
                                }
                        ?>
                            <option value="<?php echo  $tac_codigo; ?>" <?php echo $selected_tipo_acto; ?>><?php echo $tac_nombre; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="txtNumeroAcuerdo" class="font-weight-bold">Número Acuerdo / Resolución <strong style="color:#A60D20">*</strong> </label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtNumeroAcuerdo" name="txtNumeroAcuerdo" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $rac_numero; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="txtTituloNombre" class="font-weight-bold">Título / Nombre <strong style="color:#A60D20">*</strong> </label>
                    <input type="text" class="form-control caja_texto_sizer" id="txtTituloNombre" name="txtTituloNombre" data-rule-required="true" value="<?php echo $rac_titulo; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="txtLogro" class="font-weight-bold">Logro <strong style="color:#A60D20">*</strong> </label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtLogro" name="txtLogro" data-rule-required="true" value="<?php echo $rac_logro; ?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="capa_direccion" id="capa_direccion" value="<?php echo $capa_direccion; ?>">
        <input type="hidden" name="url_direccion" id="url_direccion" value="<?php echo $url_direccion; ?>">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_proceso; ?>">
        <input type="hidden" name="codigo_reporte" id="codigo_reporte" value=<?php echo $codigo_reporte; ?>>
        <input type="hidden" name="codigo_actividadpoai" id="codigo_actividadpoai" value="<?php echo $codigo_actividad; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_reporte();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
<script src="vjs/vldar_rgstrorprteactvdad.js"></script>
