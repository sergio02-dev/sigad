<?php
    include('crud/rs/autrzcion_tcnca/autrzcion_tcnca.php');
    include('crud/rs/solicitud_cdp/jclsfcdoreslinix.php'); 

    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $datos_solicitud = $objAutorizacionTecnica->datos_solicitud($codigo_solicitud);
    if($datos_solicitud){
        foreach ($datos_solicitud as $dta_solicitud) {
            $scdp_codigo = $dta_solicitud['scdp_codigo'];
            $scdp_fecha = $dta_solicitud['scdp_fecha'];
            $scdp_numero = $dta_solicitud['scdp_numero']; 
            $scdp_accion = $dta_solicitud['scdp_accion'];
            $scdp_objeto = $dta_solicitud['scdp_objeto'];
            $scdp_consecutivo = $dta_solicitud['scdp_consecutivo'];
            $scdp_codigoresolucion = $dta_solicitud['scdp_codigoresolucion'];
        }

        if($scdp_consecutivo <10){
            $ceros = '0000';
            $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
        }
        else if ($scdp_consecutivo > 9 && $scdp_consecutivo <100){
            $ceros = '000';
            $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
        }
        else if( $scdp_consecutivo >99 && $scdp_consecutivo <1000){
            $ceros = '00';
            $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
        }
        else if( $scdp_consecutivo >999 && $scdp_consecutivo <10000){
            $ceros = '0';
            $numero_solicitudCDP = $scdp_numero.'-'.$ceros.$scdp_consecutivo;
        }
        else{
            $numero_solicitudCDP = $scdp_numero.'-'.$scdp_consecutivo;
        }

        $descripcion_accion = $objAutorizacionTecnica->descripcion_accion($scdp_accion);
    }
    $tarea = "AUTORIZACI&Oacute;N TECNICA SOLICITUD N° ".$numero_solicitudCDP;
    $url_proceso = "registroautorizaciontecnicasolicitud";

?>
<form id="autorizacionTecnicaForm" role="form">
    <div class="modal-header fondo-titulo">
        <h4 class="modal-title"><strong><?php echo $tarea; ?></strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <input type="hidden" name="scdp_accion" id="scdp_accion" value="<?php echo $scdp_accion; ?>">
        <input type="hidden" name="numero_solicitud" id="numero_solicitud" value="<?php echo $numero_solicitudCDP; ?>">
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <p><strong>Fecha de Solicitud:</strong> <?php echo date('d/m/Y',strtotime($scdp_fecha)); ?></p>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Objeto:</strong> <?php echo $scdp_objeto; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Acción: </strong> <?php echo $descripcion_accion; ?></p>
            </div>
        </div>

        <?php 
            $actividades_solicitud = $objAutorizacionTecnica->actividades_solicitud($codigo_solicitud);
            if($actividades_solicitud){
                foreach ($actividades_solicitud as $dta_actvddes_solicitud) {
                    $aes_actividad = $dta_actvddes_solicitud['aes_actividad'];
                    $acp_referencia = $dta_actvddes_solicitud['acp_referencia'];
                    $acp_numero = $dta_actvddes_solicitud['acp_numero'];
                    $acp_descripcion = $dta_actvddes_solicitud['acp_descripcion'];

                    $descripcion_actividad = $acp_referencia.".".$acp_numero." ".$acp_descripcion;
        ?>
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="codigo_actividad[]" value="<?php echo $aes_actividad; ?>">
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4">Actividad: <?php echo $descripcion_actividad; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $etapa_solicitud = $objAutorizacionTecnica->etapa_solicitud($codigo_solicitud, $aes_actividad);
                            if($etapa_solicitud){
                                foreach($etapa_solicitud as $dta_etpas){
                                    $aes_codigo = $dta_etpas['aes_codigo'];
                                    $aes_etapa = $dta_etpas['aes_etapa'];
                                    $poa_referencia = $dta_etpas['poa_referencia'];
                                    $poa_numero = $dta_etpas['poa_numero'];
                                    $poa_objeto = $dta_etpas['poa_objeto'];
                                    $aes_valoretapa = $dta_etpas['aes_valoretapa'];

                                    $descripcion_etapa = $poa_referencia.".".$poa_numero." ".$poa_objeto."  $ ".number_format($aes_valoretapa,0,'','.');
                        ?>
                        <tr>
                            <td colspan="4"><?php echo $descripcion_etapa; ?> </td>
                            <input type="hidden" name="codigo_etapa<?php echo $aes_actividad; ?>[]" value="<?php echo $aes_etapa; ?>">
                        </tr>
                        <?php 
                            $clasificador_etapa = $objAutorizacionTecnica->clasificador_etapa($codigo_solicitud, $aes_etapa);
                                    if($clasificador_etapa){
                                        foreach ($clasificador_etapa as $dta_clsfcdres) {
                                            $esc_codigo = $dta_clsfcdres['esc_codigo'];
                                            $esc_clasificador = $dta_clsfcdres['esc_clasificador'];
                                            $esc_valor = $dta_clsfcdres['esc_valor'];
                                            $esc_dane = $dta_clsfcdres['esc_dane'];

                                            list($nombre, $numero) = $objConsultaLinix->nmbre_clsfcdor($esc_clasificador);
                                            //list($nombre, $numero) = $objAutorizacionTecnica->nmbre_clsfcdor($esc_clasificador);
                                            
                        ?>
                        <tr>
                            <td style="width: 60%"><?php echo $numero." - ".$nombre; ?> </td>
                            <td style="width: 20%"><?php echo "Dane: ".$esc_dane; ?> </td>
                            <td style="width: 15%"><?php echo "$".number_format($esc_valor,0,'','.'); ?> </td>
                            <td style="width: 5%">
                                <input type="hidden" name="clasificadoresEtapa<?php echo $aes_etapa; ?>[]" value="<?php echo $esc_codigo; ?>">
                                <input type="checkbox" name="etapaClasificador<?php echo $esc_codigo; ?>" value="1" checked>
                            </td>
                        </tr>
                        <?php
                                        }
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
                }
            }
        ?>

        <div class="row justify-content-center">
            <div class="col-md-12 confirmacion" style="display:none;">
                ¿Esta Seguro que desea guardar los datos?<br>
                Despues de guardado no podrá realizar modificaciones<br>
                <button type="button" class="btn btn-success" onclick="guardar();" id="guardar_autorizacion"><strong>Confirmar</strong></button>
                <button type="button" class="btn btn-danger" onclick="cancelar();"><strong>Cancelar</strong></button>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <input type="hidden" name="url_proceso" id="url_proceso" value="<?php echo $url_proceso; ?>">
        <input type="hidden" name="codigo_solicitud" id="codigo_solicitud" value="<?php echo $codigo_solicitud; ?>">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="validar_autorizacion();"><i class="far fa-save"></i> Guardar</button>
    </div>
</form>
<script src="vjs/autrzcion_tcnca/vldar_autrzcion_tcnca.js" type="text/javascript"></script>