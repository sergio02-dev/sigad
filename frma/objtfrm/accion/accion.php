<?php
    include('crud/rs/formpdi/formpdi.php');

    $codigo_proyecto = $_REQUEST['codigo_proyecto'];

     
    $list_accion = $objFormpdi->list_accion($codigo_proyecto);
?>


<label for="selAccion" class="font-weight-bold">Accion</label>
<select name="selAccion" id="selAccion" class="form-control caja_texto_sizer selectpicker" data-rule-required="true" required>
    <option value="0"  data-codigo_caracteristicas="0" data-plantafisica="0" >Seleccione la accion</option>
    <?php
        foreach ($list_accion as $data_tipoAccion) {
            $acc_codigo=$data_tipoAccion['acc_codigo'];
            $acc_referencia = $data_tipoAccion['acc_referencia'];
            $acc_descripcion=$data_tipoAccion['acc_descripcion'];
            $acc_numero = $data_tipoAccion['acc_numero'];

            $plantafisica = $objFormpdi->planta_fisica($acc_codigo); 

            

    ?>
        <option value="<?php echo  $acc_codigo; ?>" data-descripcion="<?php echo $acc_descripcion; ?>" data-plantafisica ="<?php echo $plantafisica ?>"><?php echo $acc_referencia.'.'.$acc_numero.' '.$acc_descripcion ?></option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>  

<input type="hidden" name="plantaFisica" id="plantaFisica" value="0">


<script>
    $('.selectpicker').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });


    $('#selAccion').change(function(){
        var plantafisica = $(this).find(':selected').data('plantafisica');
        
        $('#plantaFisica').val(plantafisica);

        if(plantafisica == 1){
         
            $('.plantaFisica').fadeIn(1);
            $('.productos').fadeOut(1);
        }
        else{
            $('.productos').fadeIn(1);
            $('.plantaFisica').fadeOut(1);
            
        }
    });
</script>