<?php 

    include('prcsos/plnccion/plnccion.php');

    $objPlanAccion = new PlnCcion();

    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigo_accion = $_REQUEST['codigo_accion'];

    $activity_list = $objPlanAccion->actividades_accion($codigo_accion);

?>
<input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
<input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">

<label class="font-weight-bold">Actividades * </label>
<div class="bg">
    <div>
    <?php
        if($activity_list){
            foreach ($activity_list as $data_actvty_list) {
                $acp_codigo = $data_actvty_list['acp_codigo'];
                $acp_descripcion = $data_actvty_list['acp_descripcion'];
                $acp_referencia = $data_actvty_list['acp_referencia'];
                $acp_numero = $data_actvty_list['acp_numero'];
                $acp_vigencia = $data_actvty_list['acp_vigencia'];

                $referenciaActividad = $acp_referencia.".".$acp_numero;

                $actividad_completa = $referenciaActividad." ".$acp_descripcion;


    ?>
        <div class="chiller_cb">
            <input id="actvddes<?php echo $acp_codigo; ?>" class="actyvs" name="actvddes[]" type="checkbox" value="<?php echo $acp_codigo; ?>" data-rule-required="true" required>
            <label for="actvddes<?php echo $acp_codigo; ?>"><?php echo $actividad_completa; ?></label>
            <span></span>
        </div>
    <?php
              
            }//Foreach Menu
        }//if Menu
        else{
            echo "No hay Actividades";
        }
    ?>

    </div>
    <span class="help-block" id="error"></span>
</div>

<script type="text/javascript">

    $('.actyvs').change(function(){
        var codigo_accion = $('#codigo_accion').val();
        var codigo_plan = $('#codigo_plan').val();
        var codigo_actividad = new Array();

        $('[name="actvddes[]"]:checked').each(function() {
            codigo_actividad.push($(this).val());
        });
        
        if(codigo_actividad){
            $.ajax({
                url:"listetapas",
                type:"POST",
                data:"codigo_accion="+codigo_accion+"&codigo_plan="+codigo_plan+'&codigo_actividad='+codigo_actividad,
                async:true,

                success: function(message){
                    $("#etpas_lista").empty().append(message);
                }
            });
        }
        
    });

    
</script>