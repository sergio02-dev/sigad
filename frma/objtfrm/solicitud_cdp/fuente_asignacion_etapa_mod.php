<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_etapa = $_REQUEST['codigo_etapa'];
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    $fuente_asignada_etapa = $objSolicitudCdp->fuente_asignada_etapa($codigo_etapa);   
?>
<table class="table">
    
<?php
$valor_suma_fuentes = 0;
if($fuente_asignada_etapa){
    
?>
    <tbody>
<?php
    $cantidad_fuentes = count($fuente_asignada_etapa);
    $cant = 0;
    foreach ($fuente_asignada_etapa as $dta_fnte_asgnda_etpa) {
        $asre_codigo = $dta_fnte_asgnda_etpa['asre_codigo'];
        $asre_etapa = $dta_fnte_asgnda_etpa['asre_etapa'];
        $asre_accion = $dta_fnte_asgnda_etpa['asre_etapa'];
        $asre_fuente = $dta_fnte_asgnda_etpa['asre_fuente']; 
        $asre_indicador = $dta_fnte_asgnda_etpa['asre_indicador'];
        $asrerecurso = $dta_fnte_asgnda_etpa['asre_recurso'];
        $ffi_nombre = $dta_fnte_asgnda_etpa['ffi_nombre'];
        $asre_vigenciarecurso = $dta_fnte_asgnda_etpa['asre_vigenciarecurso'];

        $gasto_asignacion = $objSolicitudCdp->gasto_asignacion($asre_codigo, $codigo_solicitud);

        $asre_recurso = $asrerecurso - $gasto_asignacion;

        $valor_suma_fuentes = $valor_suma_fuentes + $asre_recurso;        
    
?>
    
    <tr>
        <td>
            <strong><?php echo $asre_vigenciarecurso." ".str_replace('INV -','', $ffi_nombre); ?></strong>
            <br> <?php echo "valor ".$asre_recurso;?>
        </td>
        <td>
            <strong><?php echo "$ ".number_format($asre_recurso,0,'','.'); ?></strong><br>
            &nbsp;&nbsp;<input type="checkbox" name="checkCmbioval<?php echo $asre_codigo; ?>" id="checkCmbioval<?php echo $asre_codigo; ?>"  value="1" > &nbsp;Otro valor
            <input type="hidden" id="recurso_asignado<?php echo $asre_codigo; ?>" name="recurso_asignado<?php echo $asre_codigo; ?>" value="<?php echo $asre_recurso; ?>">
            <input type="hidden" name="codigo_recurso<?php echo $codigo_etapa; ?>[]" value="<?php echo $asre_codigo; ?>">

            <script type="text/javascript">
                $('#checkCmbioval<?php echo $asre_codigo; ?>').change(function(){
                    var cambio_valor = $('input:checkbox[name=checkCmbioval<?php echo $asre_codigo; ?>]:checked').val();
                    var valor_solicitado = 0;

                    if(!cambio_valor){
                        $('.valor_cambio<?php echo $asre_codigo; ?>').fadeOut('100');
                    }
                    else{
                        $('.valor_cambio<?php echo $asre_codigo; ?>').fadeIn('100');
                    }

                    $("input[name='codigo_recurso<?php echo $codigo_etapa; ?>[]']").each(function(indice, elemento) {
                        var codigo_asignacion = $(elemento).val();
                        var recurso_asignado = $('#recurso_asignado'+codigo_asignacion).val();
                        var fuente_cambio = $('#fuentes_asgnacion'+codigo_asignacion).val();
                        var cambio_valor = $('input:checkbox[name=checkCmbioval'+codigo_asignacion+']:checked').val();
                        
                        fuente_cambio = fuente_cambio.toString().replace(/\./g,'');

                        if(!cambio_valor){
                            valor_solicitado = parseFloat(valor_solicitado) + parseFloat(recurso_asignado);
                        }
                        else{
                            if(fuente_cambio == ''){
                                $("#error_vacio_asignado"+codigo_asignacion).fadeIn('300');
                                $('#error_vacio_asignado'+codigo_asignacion).html('El campo no puede ir vacío');
                                return false;
                            }
                            else{
                                $("#error_vacio_asignado"+codigo_asignacion).fadeOut('300');
                                $('#error_vacio_asignado'+codigo_asignacion).html('');
                            }
                            valor_solicitado = parseFloat(valor_solicitado) + parseFloat(fuente_cambio);
                        }
                    });
                    

                    $('#suma_validacion<?php echo $codigo_etapa; ?>').val(valor_solicitado);
                    $('#sumaValores<?php echo $codigo_etapa; ?>').html(numberWithCommas(valor_solicitado));
                });
            </script>

        </td>
        <td> 
            <div class="row valor_cambio<?php echo $asre_codigo; ?>" style="display: none;">
                <div class="col-md-12">
                    <div class="form-label-group form-group"> 
                        <input type="text" onblur="totales_solicitud<?php echo $codigo_etapa; ?>()" class="form-control caja_texto_sizer puntos_miles" placeholder="$...." id="fuentes_asgnacion<?php echo $asre_codigo; ?>" name="fuentes_asgnacion<?php echo $asre_codigo; ?>" aria-describedby="textHelp" value="<?php echo number_format($asre_recurso,0,'','.');?>" required> 
                        <div class="alert alert-danger alerta-forcliente" id="error_valor_asignado<?php echo $asre_codigo; ?>" role="alert"></div>
                        <div class="alert alert-danger alerta-forcliente" id="error_vacio_asignado<?php echo $asre_codigo; ?>" role="alert"></div>
                    </div> 
                </div>
            </div>
        </td>
    </tr>
    
<?php
        
        $cant++;
    }
?>
    <tbody>
    <tfoot>
        <tr>
            <th>TOTAL</th>
            <th colspan="2">
                $ <span id="sumaValores<?php echo $codigo_etapa; ?>"><?php echo number_format($valor_suma_fuentes,0,'','.'); ?> </span>
                <input type="hidden" name="sumatoria_etapa<?php echo $codigo_etapa; ?>" id="sumatoria_etapa<?php echo $codigo_etapa; ?>" value="<?php echo $valor_suma_fuentes; ?>">
                <input type="hidden" name="suma_validacion<?php echo $codigo_etapa; ?>" id="suma_validacion<?php echo $codigo_etapa; ?>" value="<?php echo $valor_suma_fuentes; ?>">
                <div class="alert alert-danger alerta-forcliente" id="error_solicitado_etapa<?php echo $codigo_etapa; ?>" role="alert"></div>
            </th>
        </tr> 
    </tfoot>
    <input type="hidden" id="cantidad_asignaciones<?php echo $codigo_etapa; ?>" name="cantidad_asignaciones<?php echo $codigo_etapa; ?>" value="<?php echo $cant; ?>">
<?php

}
else{
    $cantidad_fuentes = 0;
?>
<tr>
    <td>
        <strong>No hay Recusos Asignados</strong>
        <input type="hidden" id="validacion_recuersos<?php echo $codigo_etapa; ?>" value="0"/>
        <input type="hidden" id="cantidad_asignaciones<?php echo $codigo_etapa; ?>" name="cantidad_asignaciones<?php echo $codigo_etapa; ?>" value="0">
        <div class="alert alert-danger alerta-forcliente" id="recurso_slctado<?php echo $codigo_etapa; ?>" role="alert"></div>
    </td>
</tr>
<?php
}
?>
</table>

<input type="hidden" id="cantidad_fuentes<?php echo $codigo_etapa; ?>" name="cantidad_fuentes<?php echo $codigo_etapa; ?>" value="<?php echo $cantidad_fuentes; ?>">

<script type="text/javascript">
    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function totales_solicitud<?php echo $codigo_etapa; ?>(){
        var valor_solicitado = 0;

        $("input[name='codigo_recurso<?php echo $codigo_etapa; ?>[]']").each(function(indice, elemento) {
            var codigo_asignacion = $(elemento).val();
            var recurso_asignado = $('#recurso_asignado'+codigo_asignacion).val();
            var fuente_cambio = $('#fuentes_asgnacion'+codigo_asignacion).val();
            var cambio_valor = $('input:checkbox[name=checkCmbioval'+codigo_asignacion+']:checked').val();
            
            fuente_cambio = fuente_cambio.toString().replace(/\./g,'');

            if(!cambio_valor){
                valor_solicitado = parseFloat(valor_solicitado) + parseFloat(recurso_asignado);
            }
            else{
                if(fuente_cambio == ''){
                    $("#error_vacio_asignado"+codigo_asignacion).fadeIn('300');
                    $('#error_vacio_asignado'+codigo_asignacion).html('El campo no puede ir vacío');
                    return false;
                }
                else{
                    $("#error_vacio_asignado"+codigo_asignacion).fadeOut('300');
                    $('#error_vacio_asignado'+codigo_asignacion).html('');
                }
                valor_solicitado = parseFloat(valor_solicitado) + parseFloat(fuente_cambio);
            }
        });
        $('#suma_validacion<?php echo $codigo_etapa; ?>').val(valor_solicitado);
        $('#sumaValores<?php echo $codigo_etapa; ?>').html(numberWithCommas(valor_solicitado));
    }

    $(".puntos_miles").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value) {
                return value.replace(/\D/g, "").replace(/([0-9])([0-9]{0})$/, '$1').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
            });
        }
    });
</script>
<?php
    $valor_suma_fuentes = 0;
?>