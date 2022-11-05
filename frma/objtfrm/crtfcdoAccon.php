<?php


$codigo_proyecto=$_REQUEST['codigo_proyecto'];
$referencia_subsistema=$_REQUEST['referencia_subsistema'];
$referencia_proyecto=$_REQUEST['referencia_proyecto'];
$codigo_plan = $_REQUEST['codigo_plan'];

if($codigo_plan == 1){
    $look_caja_codigo = "block";
}
else{
    $look_caja_codigo = "none";
}

include('crud/rs/crtfcdos.php');

$accion=$objRscrtfcdo->selectAccion($codigo_proyecto);

?>

    <div class="form-group" id="id_accion">
        <label for="selAccion" class="font-weight-bold">Acción * </label>
        <select name="selAccion" id="selAccion"  class="form-control caja_texto_sizer selectpickerAccion" data-rule-required="true" required <?php echo $disabled; ?> >
            <option value="0" data-codigoref="0">Seleccione...</option>
            <?php
                foreach ($accion as $dataaccion) {
                    $acc_codigo = $dataaccion['acc_codigo'];
                    $acc_descripcion = $dataaccion['acc_descripcion'];
                    $acc_referencia = $dataaccion['acc_referencia'];
                    $acc_numero = $dataaccion['acc_numero'];

                    if($acc_codigo==$act_accion){
                        $select_accion="selected";
                    }
                    else{
                        $select_accion="";
                    }

                    if($codigo_plan == 1){
                        $rfrncia_accion = $referencia_subsistema.".".$acc_referencia;
                    }
                    else{
                        $rfrncia_accion = $acc_referencia.".".$acc_numero;
                    }

                    $txto_accion = $rfrncia_accion." ".$acc_descripcion;
            ?>
                <option value="<?php echo  $acc_codigo; ?>" <?php echo $select_accion; ?> data-codigoacc="<?php echo $acc_codigo; ?>"  data-codigoref="<?php echo $rfrncia_accion; ?>"> <?php echo $txto_accion; ?></option>
            <?php
                }
            ?>
        </select>
        <span class="help-block" id="error"></span>
    </div>
    <div class="form-group" style="display: <?php echo $look_caja_codigo; ?>">
        <label for="act_referencia" class="font-weight-bold">Código Actividad *</label>
        <input type="text" class="form-control caja_texto_sizer" id="act_referencia" name="act_referencia" aria-describedby="textHelp" data-rule-required="true" value="" required>
        <span class="help-block" id="error"></span>
    </div>

    <input type="hidden" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
    <script type="text/javascript">
        $('.selectpickerAccion').selectpicker({
            liveSearch: true,
            maxOptions: 1
        });
        $('#selAccion').change(function(){
            var codigo_accion=$(this).find(':selected').data('codigoacc');
            var referencia_accion=$(this).find(':selected').data('codigoref');
            var codigo_plan = $('#codigo_plan').val();

            if(codigo_plan==1){

            } 
            else{
                $.ajax({
                    url:"listactvdadesplan",
                    type:"POST",
                    data:"codigo_plan="+codigo_plan+"&codigo_accion="+codigo_accion,
                    async:true,

                    success: function(message){
                        $("#actvdades_lista").empty().append(message);
                        $('#cetfff').fadeOut();
                    }
                });
            }

            var referencia_certificado = referencia_accion+'.';

            if(referencia_accion==0){

            }
            else{
                $('#act_referencia').val(referencia_certificado);
            }
        });
    </script>
