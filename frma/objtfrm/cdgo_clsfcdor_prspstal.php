<?php
    include('crud/rs/plnccion.php');

    $fuente = $_REQUEST['fuente'];
    
    $codigos_presupuestales = $objPlanAccion->codigos_presupuestales($fuente);
?>
<label for="codigoClasificador" class="font-weight-bold"> Codigo Clasificador Presupuestal *</label>
<select name="codigoClasificador" id="codigoClasificador" class="form-control caja_texto_sizer selectpickerclasificador" data-rule-required="true" required>
    <?php
    foreach($codigos_presupuestales as $dta_codgos_presupuestales){
        $ccp_codigo = $dta_codgos_presupuestales['ccp_codigo'];
        $ccp_code = $dta_codgos_presupuestales['ccp_code'];
        $ccp_descripcion = $dta_codgos_presupuestales['ccp_descripcion'];
        $ccp_fuente = $dta_codgos_presupuestales['ccp_fuente'];
    ?>
        
        <option value="<?php echo $ccp_codigo; ?>" ><?php echo $ccp_code." - ".substr($ccp_descripcion,0,60); ?> ...</option>;
    <?php
    }
    ?>
</select>
<span class="help-block" id="error"></span>

<script type="text/javascript">
    $('.selectpickerclasificador').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>