<?php
    include('crud/rs/crtfcdos.php');
    $codigo_plan = $_REQUEST['codigo_plan'];

?>
<label for="selAccionList" class="font-weight-bold">Acciones * </label>
<select name="selAccionList" id="selAccionList"  class="form-control selectpickerAccion" data-size="5" data-rule-required="true" required <?php echo $disabled; ?> >
    <option value="0" data-acccion="">Seleccione...</option>
    <?php
        $acciones_plan = $objRscrtfcdo->acciones_plan($codigo_plan);

        foreach ($acciones_plan as $dta_accnes_pln) {

            $acc_codigo = $dta_accnes_pln['acc_codigo'];
            $acc_descripcion = $dta_accnes_pln['acc_descripcion'];
            $acc_referencia = $dta_accnes_pln['acc_referencia'];
            $sub_referencia = $dta_accnes_pln['sub_referencia'];
            $sub_ref = $dta_accnes_pln['sub_ref'];
            $pde_codigo = $dta_accnes_pln['pde_codigo'];
            $acc_numero = $dta_accnes_pln['acc_numero'];

            if($acc_codigo == $act_accion){
                $select_accion = "selected";
            }
            else{
                $select_accion = "";
            }

            if($codigo_plan == 1){
                $referencia_subsistema = $sub_referencia;
                $rfrncia_accion = $referencia_subsistema.".".$acc_referencia;
            }
            else{
                $rfrncia_accion = $acc_referencia.".".$acc_numero;
            }

            $txto_accion = "<strong>".$rfrncia_accion."</strong> ".$acc_descripcion;
    ?>
        <option value="<?php echo  $acc_codigo; ?>" data-cdgo_accion="<?php echo $acc_codigo; ?>" data-acccion="<?php echo $txto_accion; ?>"><?php echo $rfrncia_accion; ?></option>
    <?php
        }
    ?>


</select>
<span class="help-block" id="error"></span>
<br>
<span id="descripcion"></span>
<script type="text/javascript">
    $('.selectpickerAccion').selectpicker({
        liveSearch: true,
        maxOptions: 1
        
    });

    $('#selAccionList').change(function(){
        var decripcion_accion = $(this).find(':selected').data('acccion');
        var codigo_accion = $(this).find(':selected').data('cdgo_accion');
        //alert(decripcion_accion);
        $("#descripcion").html(decripcion_accion);

        if(codigo_accion==0){
        }
        else{
            $.ajax({
                url:"certificadosexistentes",
                type:"POST",
                data:"codigo_accion="+codigo_accion,
                async:true,

                success: function(message){
                    //$(".modal-body").empty().append(message);
                    $("#crtfcdos_exstntes").empty().append(message);
                }
            });

        }

    });
    
</script>