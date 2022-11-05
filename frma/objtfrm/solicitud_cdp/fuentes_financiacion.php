<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_accion = $_REQUEST['codigo_accion'];
    //echo "Codigo acción ".$codigo_accion;
    
    $list_fuentes_accion = $objSolicitudCdp->list_fuentes_accion($codigo_accion);
?>
<label for="selFuenteFinanciacion" class="font-weight-bold">Fuente Financiaci&oacute;n *</label>
<select name="selFuenteFinanciacion" id="selFuenteFinanciacion"  class="form-control caja_texto_sizer selectpicker" data-size="8" data-rule-required="true" required <?php echo $disabled; ?> >
<option value="0" data-codigo_accion="0"> Seleccione ...</option>
    <?php
        if($list_fuentes_accion){
            foreach ($list_fuentes_accion as $dta_list_fuente_financiacion) {
                $ffi_codigo = $dta_list_fuente_financiacion['ffi_codigo'];
                $ffi_nombre = $dta_list_fuente_financiacion['ffi_nombre'];
                $ffi_referencialinix = $dta_list_fuente_financiacion['ffi_referencialinix'];

                $dscrpcion = $ffi_referencialinix." ".$ffi_nombre;
        
    ?>
        <option value="<?php echo  $ffi_codigo; ?>" <?php echo $selected_fuente; ?>><?php echo $dscrpcion; ?></option>
    <?php
            }
        }
        else{
    ?>
        <option value="0"> No hay Fuentes de Financiación</option>
    <?php
        }
    ?>
</select>
<div class="alert alert-danger alerta-forcliente" id="error_fuente" role="alert"></div>
<script type="text/javascript">
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>