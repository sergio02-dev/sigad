<?php
    include('crud/rs/formpdi/formpdi.php');

    $codigo_equipo = $_REQUEST['codigo_equipo'];
     
    $list_caracteristicas = $objFormpdi->list_caracteristicas($codigo_equipo);
?>


<label for="selCaracteristicas" class="font-weight-bold">Caracteristicas</label>
<select name="selCaracteristicas" id="selCaracteristicas" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
    <option value="0"  data-codigo_caracteristicas="0">Seleccione la caracteristica</option>
    <?php
        foreach ($list_caracteristicas as $data_caracteristicas) {
            $deq_codigo=$data_caracteristicas['deq_codigo'];
            $deq_descripcion=$data_caracteristicas['deq_descripcion'];
            $deq_valor = $data_caracteristicas["deq_valor"];

    ?>
        <option value="<?php echo  $deq_codigo; ?>" data-descripcion="<?php echo $deq_descripcion; ?>" data-valor="<?php echo $deq_valor; ?>"><?php echo substr($deq_descripcion,0,120)."..."; ?></option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>  


<script>
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    $('#selCaracteristicas').change(function(){
        var descripcion = $(this).find(':selected').data('descripcion');
        var valor = $(this).find(':selected').data('valor');
       
        $('.caracteristicasNombre').html('<strong> <div class="col-sm-12 p-3"><label &nbsp;&nbsp;Descripcion: '+descripcion+" </div></p></strong>");

        $('#selValorUnitario').val(valor);
    });
</script>