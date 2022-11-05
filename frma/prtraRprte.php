<?php

    include('crud/rs/prtraRprte.php'); 

    $codigo_apertura=$_REQUEST['codigo_apertura'];   

    if($codigo_apertura){

        $objAperturaReporte->setCodigoApertura($codigo_apertura);
        $rs_AperturaReporte=$objAperturaReporte->updateAperturaReporte();

        foreach($rs_AperturaReporte as $data_aperturaReporte){
            $apr_codigo=$data_aperturaReporte['apr_codigo'];
            $apr_fechainicio=$data_aperturaReporte['apr_fechainicio'];
            $apr_fechafin=$data_aperturaReporte['apr_fechafin'];
            $apr_trimestres=$data_aperturaReporte['apr_trimestres'];
        }
        $url_guardar="crudupdateaperturareporte";
        $task = "MODIFICAR";
    }
    else{
        $url_guardar="crudaperturareporte";
        $task = "REGISTRAR";
    }
  // echo "Año Inicio : ".$pde_yearinicio." Acto Administrativo ".$pde_actoadmin;
?>
<form id="aperturareporteform" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?> APERTURA REPORTE</strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtFechaInicio" class="font-weight-bold">Fecha Inicio *</label>
                    <input type="date" class="form-control caja_texto_sizer" id="txtFechaInicio" name="txtFechaInicio" aria-describedby="textHelp" data-rule-required="true" value="<?php echo substr($apr_fechainicio,0,10);?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="txtFechaFin" class="font-weight-bold">Fecha Fin *</label>
                    <input type="date" class="form-control caja_texto_sizer" id="txtFechaFin" name="txtFechaFin" aria-describedby="textHelp" data-rule-required="true" value="<?php echo substr($apr_fechafin,0,10);?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="txtTrimestre" class="font-weight-bold">Trimestre *</label>
                    <input type="number" class="form-control caja_texto_sizer" id="txtTrimestre" name="txtTrimestre" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $apr_trimestres;?>" required>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>

        <!-- ******************** FIN FORMULARIO ************************* -->

    </div>
    <div class="modal-footer">
        <input type="hidden" name="codigoApertura" id="codigoApertura" value="<?php echo $apr_codigo; ?>">
        <input type="hidden" name="url" id="url" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger" onClick="validar_aperturareporte();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>

<script src="js/jquery.validate.min.js"></script>
<script src="vjs/registroAperturaReporte.js"></script>
