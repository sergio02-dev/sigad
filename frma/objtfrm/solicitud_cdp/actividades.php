<?php 

    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_accion = $_REQUEST['codigo_accion'];

    $activity_list = $objSolicitudCdp->actividades_accion($codigo_accion);

?>


<label class="font-weight-bold">Actividades * </label>
<div class="bg">
    <table class="table table-sm">
        <?php
            if($activity_list){
                foreach ($activity_list as $data_actvty_list) {
                    $codigo_actividad = $data_actvty_list['codigo_actividad'];
                    $referencia = $data_actvty_list['referencia'];
                    $descripcion = $data_actvty_list['descripcion'];

                    $dscrpcion = $referencia." ".$descripcion;

        ?>
            <tr>
                <td>
                    <div class="chiller_cb">
                        <input id="actvddes<?php echo $codigo_actividad; ?>" class="actyvs" name="actvddes[]" type="checkbox" value="<?php echo $codigo_actividad; ?>" data-rule-required="true" required>
                        <label for="actvddes<?php echo $codigo_actividad; ?>" id="nmbreActv<?php echo $codigo_actividad; ?>"><?php echo $dscrpcion; ?></label>
                        <span></span>
                        <input type="hidden" name="checkActvdad<?php echo $codigo_actividad; ?>" id="checkActvdad<?php echo $codigo_actividad; ?>" value="0">
                    </div>
                    <div class="row">
                        <div class="col-md-12 etapasActividad<?php echo $codigo_actividad; ?>">

                        </div>
                    </div>
                </td> 
            </tr>    
        <?php
                
                }//Foreach Menu
            }//if Menu
            else{
        ?>  
            <tr>
                <td>No hay Actividades</td>
            </tr>       
        <?php
            }
        ?>
            
    </table>
    <span class="help-block" id="error"></span>
</div>
<span id="error_actividades" style="color:#C2240B; font-weight: bold;"></span>

<span id="error_solicitud" style="color:red; font-weight: bold;"></span>
<input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>>">

<script type="text/javascript">

    $('.actyvs').change(function(){
        var codigo_actividad = this.value;
        var check_activs = $('#checkActvdad'+codigo_actividad).val();

        if(check_activs == 0){
            $('#checkActvdad'+codigo_actividad).val(1);
            $.ajax({
                url:"etapalistactvdades",
                type:"POST",
                data:'codigo_actividad='+codigo_actividad,
                async:true,

                success: function(message){
                    $(".etapasActividad"+codigo_actividad).empty().append(message);
                }
            });
        }
        else{
            $('#checkActvdad'+codigo_actividad).val(0);
            $(".etapasActividad"+codigo_actividad).empty();
        }
        
    });

    
</script>