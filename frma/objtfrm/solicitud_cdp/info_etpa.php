<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_etapa = $_REQUEST['codigo_etapa'];
    $codigo_solicitud = $_REQUEST['codigo_solicitud'];

    list($dscrpp, $prcs) = $objSolicitudCdp->dtos_etpas($codigo_etapa);
    
?>
<div class="row">
    <div class="col-md-8"><?php echo $dscrpp; ?></div>
    <div class="col-md-4"><?php echo "$".number_format($prcs,0,'','.'); ?></div>
</div>
<div class="row">
    <div class="col-md-8">
        <br>
        <input type="hidden" id="control_valor_chek<?php echo $codigo_actividad; ?>" value="0">
        <input type="checkbox" name="checkOtrval<?php echo $codigo_actividad; ?>" id="checkOtrval<?php echo $codigo_actividad; ?>" value="1"> &nbsp;Otro valor
    </div>
    <div class="col-md-4">
        <div class="form-group" id="text_valor<?php echo $codigo_actividad; ?>" style="display: none;">
            <label for="valor<?php echo $codigo_actividad; ?>" class="font-weight-bold" >Valor </label>
            <input type="text" class="form-control caja_texto_sizer puntos_miles_etapa" min="0" id="valor<?php echo $codigo_actividad; ?>" name="valor<?php echo $codigo_actividad; ?>" aria-describedby="textHelp" value="<?php echo number_format($prcs,0,'','.'); ?>" required>
            <span id="error_valor_etpa<?php echo $codigo_actividad; ?>" style="color:red; font-weight: bold;"></span>
            <input type="hidden" name="valor_etapa<?php echo $codigo_actividad; ?>" id="valor_etapa<?php echo $codigo_actividad; ?>" value="<?php echo $prcs; ?>">
        </div> 
    </div>
</div>
<script type="text/javascript">
    $('#checkOtrval<?php echo $codigo_actividad; ?>').change(function(){
        var val_other = $('input:checkbox[name=checkOtrval<?php echo $codigo_actividad; ?>]:checked').val();
        
        if(val_other==1){
            $('#text_valor<?php echo $codigo_actividad; ?>').fadeIn(100);
            $('#control_valor_chek<?php echo $codigo_actividad; ?>').val(1);
        }
        else{
            $('#text_valor<?php echo $codigo_actividad; ?>').fadeOut(100);
            $('#control_valor_chek<?php echo $codigo_actividad; ?>').val(0);
        }
    });
</script>