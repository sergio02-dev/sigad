<?php
    include('crud/rs/rp/rprte_rp.php');

    $codigo_proyecto = $_REQUEST['codigo_proyecto'];
    $codigo_plan = $_REQUEST['codigo_plan'];

    $nivel_tres = $objRprteRP->nivel_tres($codigo_plan);

    $list_nivel_tres = $objRprteRP->list_nivel_tres($codigo_proyecto);

?>
<div class="col-md-12">
    <div class="form-group">
        <label for="selAccion" class="font-weight-bold"> <?php echo $nivel_tres; ?> *</label>
        <select name="selAccion" id="selAccion" class="form-control caja_texto_sizer selectpickerProyecto" data-rule-required="true">
            <option value="0" data-codigo_accion="0">Seleccione...</option>
            <?php
            foreach ($list_nivel_tres as $dat_nivel_tres) {
                $sub_referencia = $dat_nivel_tres['sub_referencia'];
                $acc_codigo = $dat_nivel_tres['acc_codigo'];
                $acc_referencia = $dat_nivel_tres['acc_referencia'];
                $acc_descripcion = $dat_nivel_tres['acc_descripcion'];
                $acc_proyecto = $dat_nivel_tres['acc_proyecto'];
                $acc_numero = $dat_nivel_tres['acc_numero'];

                if($codigo_plan == 1){
                    $descrpcion = $sub_referencia.".".$acc_referencia." ".$acc_descripcion;
                }
                else{
                    $descrpcion = $acc_referencia.".".$acc_numero." ".$acc_descripcion;
                }

            ?>
                <option value="<?php echo $acc_codigo; ?>" data-codigo_accion="<?php echo $acc_codigo; ?>"><?php echo substr($descrpcion,0,85); ?> ...</option>
            <?php
                }
            ?>
        </select>
        <div class="alert alert-danger alerta-forcliente" id="error_accion" role="alert"></div>
    </div>
</div>

<script type="text/javascript">

    $('.selectpickerProyecto').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('#selAccion').change(function(){
        var codigo_accion = $(this).find(':selected').data('codigo_accion');

        if(codigo_accion == 0){

        }
        else{
            $.ajax({
                url:"listactividadesrp",
                type:"POST",
                data:"codigo_accion="+codigo_accion,
                async:true,

                success: function(message){
                    $(".actividad").empty().append(message);
                }
            });
        }
    });
</script>