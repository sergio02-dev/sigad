<?php
include('crud/rs/crtfcdos.php');

$codigo_plan = $_REQUEST['codigo_plan'];

$subsistema_plan = $objRscrtfcdo->subsistema_plan($codigo_plan);
?>
<label for="selTipoActividad" class="font-weight-bold">Subsistema * </label> <a href="Javascript:modalInfo();"></a>
<select name="selSubsistema" id="selSubsistema"  class="form-control caja_texto_sizer" data-rule-required="true" required <?php echo $disabled; ?> >
    <option value="0" data-codigosub='0'>Seleccione...</option>
    <?php
        foreach ($subsistema_plan as $dta_subsstema_plan) {

            $sub_codigo=$dta_subsstema_plan['sub_codigo'];
            $sub_nombre=$dta_subsstema_plan['sub_nombre'];
            $sub_referencia=$dta_subsstema_plan['sub_referencia'];

            if($sub_codigo==$sub_codigoA){
                $select_subsistema="selected";
            }
            else{
                $select_subsistema="";
            }
    ?>      
        <option value="<?php echo  $sub_codigo; ?>" <?php echo $select_subsistema; ?> data-codigosub="<?php echo $sub_codigo; ?>" data-referencia="<?php echo $sub_referencia; ?>"><?php echo $sub_nombre; ?></option>
    <?php
        }

    ?>
</select>
<input type="hidden" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
<span class="help-block" id="error"></span>

<script type="text/javascript">
    $('#selSubsistema').change(function(){
        var codigo_subsistema=$(this).find(':selected').data('codigosub');
        var referencia_subsistema=$(this).find(':selected').data('referencia');
        var codigo_plan = $('#codigo_plan').val();
        //alert('--->'+referencia_subsistema);
        if(codigo_subsistema==0){

        }
        else{
            $.ajax({
                url:"certificadoproyecto",
                type:"POST",
                data:"codigo_subsistema="+codigo_subsistema+"&referencia_subsistema="+referencia_subsistema+'&codigo_plan='+codigo_plan,
                async:true,

                success: function(message){
                    //$(".modal-body").empty().append(message);
                    $("#id_proyecto").empty().append(message);
                }
            });

        }
    });
</script>