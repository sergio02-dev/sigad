<?php
    include('crud/rs/crtfcdos.php');

    $codigo_accion = $_REQUEST['codigo_accion'];

    $certificados_accion = $objRscrtfcdo->certificados_accion($codigo_accion);
?>
<label for="selCertificadoModificar" class="font-weight-bold">Certificados por Acci&oacute;n* </label>
<select name="selCertificadoModificar" id="selCertificadoModificar"  class="form-control selectpickerCertificado" data-size="5" data-rule-required="true" required <?php echo $disabled; ?> >
    <option value="0" data-codigo_certificado="0">Seleccione...</option>
    <?php

        foreach ($certificados_accion as $dta_crtfcdo) {

            $cer_codigo = $dta_crtfcdo['act_codigo'];
            $cer_certificado = $dta_crtfcdo['act_certificado'];


    ?>
        <option value="<?php echo  $cer_codigo; ?>" data-codigo_certificado="<?php echo $cer_codigo; ?>" data-certificado="<?php echo $cer_certificado; ?>"><?php echo $cer_certificado; ?></option>
    <?php
        }
    ?>


</select>
<span class="help-block" id="error"></span>

<script type="text/javascript">
    $('.selectpickerCertificado').selectpicker({
        liveSearch: true,
        maxOptions: 1
        
    });

    $('#selCertificadoModificar').change(function(){
        var codigo_certificado = $(this).find(':selected').data('codigo_certificado');
        var certificado = $(this).find(':selected').data('certificado');
        //alert(certificado);

        if(codigo_certificado==0){
        }
        else{
            $.ajax({
                url:"listinfocertificado",
                type:"POST",
                data:"codigo_certificado="+codigo_certificado+'&certificado='+certificado,
                async:true,

                success: function(message){
                    //$(".modal-body").empty().append(message);
                    $("#info_crtfcdo").empty().append(message);
                }
            });

        }

    });
</script>