<?php
    include('crud/rs/rp/rprte_rp.php');

    $sub_sistema = $_REQUEST['sub_sistema'];
    $codigo_plan = $_REQUEST['codigo_plan'];

    $nivel_dos = $objRprteRP->nivel_dos($codigo_plan);

    $list_nivel_dos = $objRprteRP->list_nivel_dos($sub_sistema);

?>
<div class="col-md-12">
    <div class="form-group">
        <label for="selProyecto" class="font-weight-bold"> <?php echo $nivel_dos; ?> *</label>
        <select name="selProyecto" id="selProyecto" class="form-control caja_texto_sizer selectpickerProyecto" data-rule-required="true">
            <option value="0" data-codigo_proyecto="0">Seleccione...</option>
            <?php
            foreach ($list_nivel_dos as $dat_nivel_dos) {
                $pro_codigo = $dat_nivel_dos['pro_codigo'];
                $sub_referencia = $dat_nivel_dos['sub_referencia'];
                $pro_referencia = $dat_nivel_dos['pro_referencia'];
                $pro_numero = $dat_nivel_dos['pro_numero'];
                $pro_descripcion = $dat_nivel_dos['pro_descripcion'];

                if($codigo_plan == 1){
                    $descrpcion = $sub_referencia.".".$pro_referencia." ".$pro_descripcion;
                }
                else{
                    $descrpcion = $pro_referencia.".".$pro_numero." ".$pro_descripcion;
                }

            ?>
                <option value="<?php echo $pro_codigo; ?>" data-codigo_proyecto="<?php echo $pro_codigo; ?>" data-codigo_plan="<?php echo $codigo_plan; ?>"><?php echo substr($descrpcion,0,85); ?> ...</option>
            <?php
                }
            ?>
        </select>
        <div class="alert alert-danger alerta-forcliente" id="error_proyecto" role="alert"></div>
    </div>
</div>

<script type="text/javascript">

    $('.selectpickerProyecto').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('#selProyecto').change(function(){
        var codigo_proyecto = $(this).find(':selected').data('codigo_proyecto');
        var codigo_plan = $(this).find(':selected').data('codigo_plan');

        if(codigo_proyecto == 0){

        }
        else{
            $.ajax({
                url:"listaccionrp",
                type:"POST",
                data:"codigo_proyecto="+codigo_proyecto+'&codigo_plan='+codigo_plan,
                async:true,

                success: function(message){
                    $(".accion").empty().append(message);
                }
            });
        }
    });
</script>