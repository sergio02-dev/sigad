<?php 

    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_accion = $_REQUEST['codigo_accion'];

    $activity_list = $objSolicitudCdp->actividades_accion($codigo_accion);

?>


<label class="font-weight-bold">Actividades * </label>
<div class="bg">
    <div>
    <?php
        if($activity_list){
            foreach ($activity_list as $data_actvty_list) {
                $codigo_actividad = $data_actvty_list['codigo_actividad'];
                $referencia = $data_actvty_list['referencia'];
                $descripcion = $data_actvty_list['descripcion'];

                $dscrpcion = $referencia." ".$descripcion;

    ?>
       
        <div class="chiller_cb">
            <input id="actvddes<?php echo $codigo_actividad; ?>" class="actyvs" name="actvddes[]" type="checkbox" value="<?php echo $codigo_actividad; ?>" data-rule-required="true" required>
            <label for="actvddes<?php echo $codigo_actividad; ?>" id="nmbreActv<?php echo $codigo_actividad; ?>"><?php echo $dscrpcion; ?></label>
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
<span id="error_solicitud" style="color:red; font-weight: bold;"></span>
<input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>>">

<script type="text/javascript">

    $('.actyvs').change(function(){
        var codigo_actividad = new Array();
        var codigo_accion = $('#codigo_accion').val();

        $('[name="actvddes[]"]:checked').each(function() {
            codigo_actividad.push($(this).val());
        });
        
        if(codigo_actividad){
            $.ajax({
                url:"etapasolicitudcdp",
                type:"POST",
                data:'codigo_actividad='+codigo_actividad+'&codigo_accion='+codigo_accion,
                async:true,

                success: function(message){
                    $("#etpas_lista").empty().append(message);
                }
            });
        }
        
    });

    
</script>