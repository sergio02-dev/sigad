<?php 
    include('crud/rs/plnDsrrllo.php');
    $codigo_nivelUno=$_REQUEST['codigo_nivelUno'];
    $nombreNivelDos=$_REQUEST['nombreNivelDos'];

    $rs_nivelDos=$objRsPlanDesarrollo->nivelDos($codigo_nivelUno);
?>
<style>
    .alert.alert-danger.alerta-forcliente{
        display: none;
        padding: 0;
        color: red ;
        font-weight: bold;
    }
</style>
<label for="selNivelDos" class="font-weight-bold"> <?php echo $nombreNivelDos; ?> *</label>
<select name="selNivelDos" id="selNivelDos" class="form-control caja_texto_sizer selectpickerPro proFiltro" data-rule-required="true" required>
    <option value="0" data-cod_pro="0">Seleccione...</option>
    <?php
        foreach ($rs_nivelDos as $data_nivelDos) {
            $pro_codigo=$data_nivelDos['pro_codigo'];
            $pro_referencia=$data_nivelDos['pro_referencia'];
            $pro_descripcion=$data_nivelDos['pro_descripcion'];
            $pro_numero=$data_nivelDos['pro_numero'];

            $referencialDos=$pro_referencia.".".$pro_numero;

    
    ?>
        <option value="<?php echo  $pro_codigo; ?>" data-cod_pro="<?php echo $pro_codigo; ?>" data-referencia="<?php echo $pro_referencia; ?>" data-numero="<?php echo $pro_numero; ?>"><?php echo substr($referencialDos." ".$pro_descripcion,0,100); ?> ...</option>
    <?php
        }
    ?>
</select>
<span class="help-block" id="error"></span>
<div class="alert alert-danger alerta-forcliente" id="error_nivel_dos" role="alert"></div>


<script type="text/javascript">
    $('#selNivelDos').change(function(){
        var referencianiveldos = $(this).find(':selected').data('referencia');
        var numero = $(this).find(':selected').data('numero');
        var cod_pro = $(this).find(':selected').data('cod_pro');

        var referencianiveltres=referencianiveldos+'.'+numero;

        $('#txtReferencia').val(referencianiveltres);

        if(cod_pro==0){

        }
        else{
            $.ajax({
                url:"accionproyectofiltro",
                type:"POST",
                data:"cod_pro="+cod_pro,
                async:true,

                success: function(message){
                    $(".selAccion").empty().append(message);
                }
            });
        }

    });

    $('.selectpickerPro').selectpicker({
        liveSearch: true,
        maxOptions: 1
    });

    /*$('.proFiltro').change(function(){
        
        var plan_desarrollo = $('#plan_desarrollo').val();
        alert('Hola '+cod_pro);
        
    });*/
</script>