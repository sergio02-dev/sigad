<?php 
    include('crud/rs/rprte_plan_accion/rprte_plan_accion.php');

    $cod_pro = $_REQUEST['cod_pro'];

    $nmbre_nvel_tres = $objRprtePlnAccion->nmbre_nvel_tres($cod_pro);

    $list_acciones = $objRprtePlnAccion->list_acciones($cod_pro);
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<label for="selNivelTres" class="font-weight-bold"> <?php echo $nmbre_nvel_tres; ?> *</label>
<select name="selNivelTres" id="selNivelTres" class="form-control caja_texto_sizer selectpickerAccion" data-rule-required="true" required>
    <option value="0" data-accion_codigo="0">Seleccione...</option>
    <?php
        foreach ($list_acciones as $dta_acciones) {
            $acc_codigo = $dta_acciones['acc_codigo'];
            $acc_referencia = $dta_acciones['acc_referencia'];
            $acc_numero = $dta_acciones['acc_numero'];
            $acc_descripcion = $dta_acciones['acc_descripcion'];

            $dscrpcion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;

    
    ?>
        <option value="<?php echo  $acc_codigo; ?>" data-accion_codigo="<?php echo $acc_codigo; ?>"><?php echo substr($dscrpcion,0,110); ?> ...</option>
    <?php
        }
    ?>
</select>
<div class="alert alert-danger alerta-forcliente" id="error_nivel_tres" role="alert"></div>

<script>
    $('#selNivelTres').change(function(){
        var accion_codigo = $(this).find(':selected').data('accion_codigo');

        if(accion_codigo == 0){

        }
        else{
            $.ajax({
                url:"actividadaccionfiltro",
                type:"POST",
                data:"accion_codigo="+accion_codigo,
                async:true,

                success: function(message){
                    $(".selActividad").empty().append(message);
                }
            });
        }
    });

    $('.selectpickerAccion').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });
</script>

<div class="row">
    <div class="col-sm-12">&nbsp; </div>
</div>