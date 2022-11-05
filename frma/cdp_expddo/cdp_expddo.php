<?php
    function tildes($palabra){
        $no_admitidas = array("á","é","í","ó","ú","ñ");
        $admitidas = array("Á", "É", "Í", "Ó", "Ú","Ñ");
        $texto = str_replace($no_admitidas, $admitidas ,$palabra);
        return $texto;
    }
    include('crud/rs/cdp_expddo/cdp_expddo.php');

    $codigo_cdp = $_REQUEST['codigo_cdp'];

    $datos_cdp_expedido = $objCdpExpedido->datos_cdp_expedido($codigo_cdp);

    foreach($datos_cdp_expedido as $dat_cdp_expedido){
        $scdp_codigo = $dat_cdp_expedido['scdp_codigo'];
        $scdp_fecha = $dat_cdp_expedido['scdp_fecha'];
        $scdp_numero = $dat_cdp_expedido['scdp_numero'];
        $scdp_accion = $dat_cdp_expedido['scdp_accion'];
        $cdp_numeroexpedicion = $dat_cdp_expedido['cdp_numeroexpedicion'];
        $cdp_fecha = $dat_cdp_expedido['cdp_fecha'];
    }

    $codigo_plan_accion = $objCdpExpedido->codigo_plan_accion($scdp_accion);

    $nombre_nivel_tres = $objCdpExpedido->nombre_nivel_tres($codigo_plan_accion);

    $descripcion_accion = $objCdpExpedido->descripcion_accion($scdp_accion);

    $task = "CDP EXPEDIDO";
?>

<form id="cdpexpedido" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $task; ?></strong></h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- ******************** INICIO FORMULARIO ************************* -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align: center;">DATOS CDP EXPEDIDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Fecha Expedici&oacute;n</strong> <?php echo date('d/m/Y',strtotime($cdp_fecha)); ?></td>
                            <td colspan="2"><strong>No. CDP</strong> <?php echo $cdp_numeroexpedicion; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo "<strong>".strtoupper(tildes($nombre_nivel_tres))."</strong>. ".$descripcion_accion; ?></td>
                        </tr>
                        <?php
                            $actividades_solicitud = $objCdpExpedido->actividades_solicitud($scdp_codigo);
                            if($actividades_solicitud){
                                foreach ($actividades_solicitud as $dat_actividades_solicitud) {
                                    $aes_actividad = $dat_actividades_solicitud['aes_actividad'];
                                    $acp_referencia = $dat_actividades_solicitud['acp_referencia'];
                                    $acp_numero = $dat_actividades_solicitud['acp_numero'];
                                    $acp_descripcion = $dat_actividades_solicitud['acp_descripcion'];
                        ?>
                        <tr>
                            <td colspan="3"><strong>ACTIVIDAD: <?php echo $acp_referencia.".".$acp_numero; ?></strong> <?php echo $acp_descripcion; ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align: center;">ETAPAS</th>
                        </tr>
                        <?php
                                    $etapa_actividad_solicitud = $objCdpExpedido->etapa_actividad_solicitud($scdp_codigo, $aes_actividad);
                                    if($etapa_actividad_solicitud){
                                        foreach ($etapa_actividad_solicitud as $dta_etpas) {
                                            $aes_codigo = $dta_etpas['aes_codigo'];
                                            $aes_etapa = $dta_etpas['aes_etapa'];
                                            $aes_valoretapa = $dta_etpas['aes_valoretapa']; 
                                            $aes_otrovalor = $dta_etpas['aes_etapa'];
                                            $poa_referencia = $dta_etpas['poa_referencia'];
                                            $poa_numero = $dta_etpas['poa_numero']; 
                                            $poa_objeto = $dta_etpas['poa_objeto'];

                                           $descripcion_etapa = $poa_referencia.".".$poa_numero." ".$poa_objeto;
                        ?>
                        <tr>
                            <td colspan="2"><?php echo $descripcion_etapa; ?></td>
                            <td><?php echo "$".number_format($aes_valoretapa,0,'','.'); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3" style="text-align: center;">FUENTES DE FINANCIACI&Oacute;N</th>
                        </tr>
                        <?php
                                            $clasificadores_solicitud = $objCdpExpedido->clasificadores_solicitud($scdp_codigo, $aes_etapa);

                                            $recursos_designados = $objCdpExpedido->recursos_designados($scdp_codigo, $aes_etapa);
                                            $cantidad_recursos = count($recursos_designados);
                                            $num = 1;
                                            foreach ($recursos_designados as $dta_rcrsos) {
                                                $aso_codigo = $dta_rcrsos['aso_codigo']; 
                                                $aso_otrovalor  = $dta_rcrsos['aso_otrovalor'];
                                                $aso_valor = $dta_rcrsos['aso_valor'];
                                                $asre_vigenciarecurso = $dta_rcrsos['asre_vigenciarecurso'];
                                                $ffi_nombre = $dta_rcrsos['ffi_nombre'];
                                                

                                                $descrpcion_recurso = $asre_vigenciarecurso." ".str_replace('INV -','', $ffi_nombre);
                        ?>
                        <tr>
                            <td><?php echo $descrpcion_recurso; ?></td>
                            <td><?php echo "$".number_format($aso_valor,0,'','.'); ?></td>
                            <?php
                                if($num == 1){
                            ?>
                            <td rowspan="<?php echo $cantidad_recursos; ?>">
                                <strong>Clasificadores: </strong><br>
                                <?php echo $clasificadores_solicitud; ?>
                            </td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php
                                                $num++;
                                            }

                                        }
                                    }
                                    
                                }
                            }
                        ?>  
                        
                    </tbody>
                </table>
            </div>
        </div>


        
        
        <!-- ******************** FIN FORMULARIO ************************* -->
    </div>
    <div class="modal-footer">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_guardar; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn-danger" onClick="validar_expedicion();"><i class="far fa-save"></i> Guardar</button>-->
    </div>
</form>



<script src="js/jquery.validate.min.js"></script>
