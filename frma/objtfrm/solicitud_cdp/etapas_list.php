<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $etapas_list = $objSolicitudCdp->etapas_actividad($codigo_actividad);

?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="selEtapa<?php echo $codigo_actividad; ?>" class="font-weight-bold"><?php echo $nombre_nivel_tres; ?> *</label>
            <select name="selEtapa<?php echo $codigo_actividad; ?>" id="selEtapa<?php echo $codigo_actividad; ?>"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
            <option value="0" data-codigo_accion="0"> Seleccione ...</option>
                <?php
                    if($etapas_list){
                        foreach ($etapas_list as $dta_etpas_list) {
                            $poa_codigo = $dta_etpas_list['poa_codigo'];
                            $poa_referencia = $dta_etpas_list['poa_referencia'];
                            $poa_objeto = $dta_etpas_list['poa_objeto']; 
                            $poa_recurso = $dta_etpas_list['poa_recurso'];
                            $poa_estado = $dta_etpas_list['poa_estado'];
                            $poa_numero = $dta_etpas_list['poa_numero']; 
                            $poa_vigencia = $dta_etpas_list['poa_vigencia'];
                            $acp_codigo = $dta_etpas_list['acp_codigo'];
                            $poa_logroejecutado = $dta_etpas_list['poa_logroejecutado'];

                            $etpa_nombre = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                            $poai_etapa_gasto = $objSolicitudCdp->poai_etapa_gasto($poa_codigo, $codigo_solicitud);

                            $rcursos_etapa = $poa_recurso - $poai_etapa_gasto;

                    
                ?>
                    <option value="<?php echo  $poa_codigo; ?>"><?php echo substr($etpa_nombre,0,110); ?></option>
                <?php
                        }
                    }
                    else{
                ?>
                    <option value="0"> No hay <?php echo $nombre_nivel_tres; ?></option>
                <?php
                    }
                ?>
            </select>
            <div class="alert alert-danger alerta-forcliente" id="error_etapaactivdad<?php echo $codigo_actividad; ?>" role="alert"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>