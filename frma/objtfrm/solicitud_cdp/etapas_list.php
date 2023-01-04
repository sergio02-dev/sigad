<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $etapas_list = $objSolicitudCdp->etapas_actividad($codigo_actividad);

?>
<div class="row"><div class="col-md-12">&nbsp;</div></div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="etpass<?php echo $codigo_actividad; ?>" class="font-weight-bold">Etapa *</label>
            <select name="etpass<?php echo $codigo_actividad; ?>" id="etpass<?php echo $codigo_actividad; ?>" class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
            <option value="0" data-codigo_etapa="0" data-descrpcion="" data-rcursos_etapa="0"> Seleccione ...</option>
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
                    <option value="<?php echo  $poa_codigo; ?>" data-codigo_etapa="<?php echo $poa_codigo; ?>" data-descrpcion="<?php echo $etpa_nombre; ?>" data-rcursos_etapa="<?php echo $rcursos_etapa; ?>"><?php echo substr($etpa_nombre,0,110); ?></option>
                <?php
                        }
                    }
                    else{
                ?>
                    <option value="0" data-codigo_etapa="0" data-descrpcion="" data-rcursos_etapa="0"> No hay Etapas</option>
                <?php
                    }
                ?>
            </select>
            <div class="alert alert-danger alerta-forcliente" id="error_etapaactivdad<?php echo $codigo_actividad; ?>" role="alert"></div>
        </div>
    </div>
</div>

<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-8 desc<?php echo $codigo_actividad; ?>">uno</div>
    <div class="col-md-4 pric<?php echo $codigo_actividad; ?>"></div>
</div>

<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-8 desc<?php echo $codigo_actividad; ?>">dos</div>
    <div class="col-md-4 pric<?php echo $codigo_actividad; ?>"></div>
</div>

<div class="row datosEtapa<?php echo $codigo_actividad; ?>" style="display:none;">
    <div class="col-md-8 desc<?php echo $codigo_actividad; ?>">tres</div>
    <div class="col-md-4 pric<?php echo $codigo_actividad; ?>"></div>
</div>

<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('#etpass<?php echo $codigo_actividad; ?>').change(function(){
        var codigo_etapa = $(this).find(':selected').data('codigo_etapa');
        var descrpcion = $(this).find(':selected').data('descrpcion');
        var rcursos_etapa = $(this).find(':selected').data('rcursos_etapa');
        
        if(codigo_etapa == 0){
            $('.datosEtapa<?php echo $codigo_actividad; ?>').fadeOut(1);
            $('.desc<?php echo $codigo_actividad; ?>').html('');
            $('.pric<?php echo $codigo_actividad; ?>').html('');
        }
        else{
            $('.datosEtapa<?php echo $codigo_actividad; ?>').fadeIn(1);
            $('.desc<?php echo $codigo_actividad; ?>').html(descrpcion);
            $('.pric<?php echo $codigo_actividad; ?>').html("$ "+numberWithCommas(rcursos_etapa));            
        }
    });
</script>