<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');

    $codigo_accion = $_REQUEST['codigo_accion'];

    $activity_list = $objSolicitudCdp->actividades_accion($codigo_accion);
    list($resolucionPersona,$resolucionFecha) = $objSolicitudCdp->resolucionPersona($codigo_accion);
   

    $codigo_session = $_SESSION['idusuario'];
    if ($codigo_session == 1 || $codigo_session==201604281729001 || $_SESSION['perfil']==3 || $_SESSION['perfil']==1){

        $jsonOrdenadores= $objSolicitudCdp->jsonOrdenadores($codigo_accion);

?>
<div class="row">          
    <div class="col-sm-11" >
        <div class="form-group ">
                <label for="selOrdenador" class="font-weight-bold">Ordenador</label>
                <select name="selOrdenador" id="selOrdenador" class="form-control caja_texto_sizer selectpicker">
                    <option value="0" data-codigo_ordenador="0">Seleccione...</option>
                        <?php
                            if($jsonOrdenadores){
                                foreach ($jsonOrdenadores as $dat_ordenadores) {
                                    $res_codigo = $dat_ordenadores['res_codigo'];
                                    $rep_resolucion = $dat_ordenadores['rep_resolucion'];
                                    $rep_fecharesolucion = $dat_ordenadores['rep_fecharesolucion'];
                                    $nombre_ordenadores = $dat_ordenadores['nombre_ordenadores'];
                        ?>
                            <option value="<?php echo  $res_codigo; ?>" data-codigo_ordenador="<?php echo  $res_codigo; ?>" data-codigo_fecharesolucion="<?php echo $rep_fecharesolucion;?>" data-codigo_resolucion="<?php echo $rep_resolucion;?>"><?php echo $nombre_ordenadores; ?></option>              
                            
                        <?php
                            }  
                        }
                        else{

                        ?>
                        <option value="0"> No hay ordenadores</option>
                    <?php
                        }
                    ?>
                    
                </select>

            <span class="help-block" id="error"></span>    
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="txtResolucion" class="font-weight-bold">Resolucion </label>
            <input type="text" class="form-control caja_texto_sizer" id="txtResolucion" aria-describedby="textHelp" data-rule-required="true" value="<?php  $rep_resolucion; ?>" readonly>
            <input type="hidden" name="txtResolucion" id="txtResolucion2" value="<?php  echo $rep_resolucion ; ?>">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="txtFechaResolucion" class="font-weight-bold">Fecha de Resolucion </label>
            <input type="date" class="form-control caja_texto_sizer" id="txtFechaResolucion" aria-describedby="textHelp" data-rule-required="true" value="<?php   $rep_fecharesolucion ; ?>" readonly >
            <input type="hidden" name="txtFechaResolucion" id="txtFechaResolucion2" value="<?php  echo  $rep_fecharesolucion ; ?>">
        </div>
    </div>  
</div>
<div class="alert alert-danger alerta-forcliente" id="error_resolucion" role="alert"></div>
    
 


<?php  
    }
    else{
?>
<div class="row">
    <div class="col-sm-6" >
        <div class="form-group">
            <label for="txtResolucion" class="font-weight-bold">Resolucion </label>
            <input type="text" class="form-control caja_texto_sizer" id="txtResolucion" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo $resolucionPersona ; ?>" readonly>
            <input type="hidden" name="txtResolucion"  value="<?php  echo $resolucionPersona ; ?>">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="txtFechaResolucion" class="font-weight-bold">Fecha de Resolucion </label>
            <input type="date" class="form-control caja_texto_sizer" id="txtFechaResolucion" aria-describedby="textHelp" data-rule-required="true" value="<?php  echo $resolucionFecha ; ?>" readonly >
            <input type="hidden" name="txtFechaResolucion" value="<?php  echo $resolucionFecha ; ?>">
        </div>
    </div>  
</div>
<div class="alert alert-danger alerta-forcliente" id="error_resolucion" role="alert"></div>
<?php 
}
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

    $('#selOrdenador').change(function(){
        var codigo_ordenador = $(this).find(':selected').data('codigo_ordenador');
        var codigo_resolucion = $(this).find(':selected').data('codigo_resolucion');
        var codigo_fecharesolucion = $(this).find(':selected').data('codigo_fecharesolucion');
        
        $('#txtFechaResolucion').val(codigo_fecharesolucion);
        $('#txtResolucion').val(codigo_resolucion);
        $('#txtFechaResolucion2').val(codigo_fecharesolucion);
        $('#txtResolucion2').val(codigo_resolucion);

    });
    
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    
</script>