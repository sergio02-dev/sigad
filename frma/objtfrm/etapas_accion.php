<?php 

    include('prcsos/plnccion/plnccion.php');
    include('crud/rs/crtfcdos.php');

    $objPlanAccion = new PlnCcion();

    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigo_accion = $_REQUEST['codigo_accion'];
    $cdigo_actividad = $_REQUEST['codigo_actividad'];
    $codigo_certificado = $_REQUEST['codigo_certificado'];

    $ver_otroValor = "none";

    //print_r($codigo_actividad);
    if($cdigo_actividad){
        $etapas_list = $objPlanAccion->etapas_actividad($cdigo_actividad);
        //$sma_etpas = $objRscrtfcdo->sma_etpas($codigo_certificado);
    }
    else{
        $etapas_list = "";
    }

    $valor_etps = 0;
    
?>
<div class="form-group">
    <input type="hidden" name="codigo_accion" id="codigo_accion" value="<?php echo $codigo_accion; ?>">
    <input type="hidden" name="codigo_plan" id="codigo_plan" value="<?php echo $codigo_plan; ?>">
    <input type="hidden" name="cdigo_actividad" id="cdigo_actividad" value="<?php echo $cdigo_actividad; ?>">

    <label class="font-weight-bold">Etapas * </label>
    <div class="bg">
        <table class="table table-sm">
            <?php 
                if($etapas_list){
                    foreach($etapas_list as $dta_etpas_list){
                        $poa_codigo = $dta_etpas_list['poa_codigo'];
                        $poa_referencia = $dta_etpas_list['poa_referencia'];
                        $poa_objeto = $dta_etpas_list['poa_objeto']; 
                        $poa_recurso = $dta_etpas_list['poa_recurso'];
                        $poa_estado = $dta_etpas_list['poa_estado'];
                        $poa_numero = $dta_etpas_list['poa_numero']; 
                        $poa_vigencia = $dta_etpas_list['poa_vigencia'];
                        $acp_codigo = $dta_etpas_list['acp_codigo'];
                        $poa_logroejecutado = $dta_etpas_list['poa_logroejecutado'];

                        $etpa_nombre = $poa_referencia.".".$poa_numero." ".$poa_objeto;

                        if($codigo_certificado){
                            $checked_etapa = $objPlanAccion->checked_etapa($codigo_certificado, $poa_codigo);
                            if($checked_etapa == 0){
                                $checkear_etapa = "";
                            }
                            else{
                                $checkear_etapa = "checked";
                                $valor_etps = $valor_etps + $poa_recurso;
                            }
                        }

                        
            ?>
            <tr>
                <td>
                    <div class="chiller_cb">
                        <input id="actvddes<?php echo $poa_codigo; ?>" class="etapps" name="etpass[]" data-valor_etapa="<?php echo $poa_recurso; ?>" type="checkbox" value="<?php echo $poa_codigo; ?>" <?php echo $checkear_etapa; ?> data-rule-required="true" required>
                        <label for="actvddes<?php echo $poa_codigo; ?>"><?php echo $etpa_nombre; ?></label>
                        <span></span>
                    </div>
                </td>
                <td>&nbsp;<br><?php echo "$".number_format($poa_recurso,0,'','.'); ?></td>
            </tr>
            <?php
                    }
                }
                else{
            ?>
            <tr>
                <td colspan="2">No hay Etapas</td>
            </tr>
            <?php
                }
            ?>
        </table>
        
    </div>
    <span class="help-block" id="error"></span>

</div>

<div class="form-group">
    <label for="SumTotal" class="font-weight-bold">Total*</label>
    <input type="text" class="form-control" id="SumTotal" name="SumTotal" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $valor_etps; ?>" required readonly>
    <span class="help-block" id="error"></span>            
</div>

<div class="form-group">
    <div class="bg">
        <div class="chiller_cb">
            <input id="checkedOtroValor" name="checkedOtroValor"  type="checkbox" value="1" data-rule-required="true" required>
            <label for="checkedOtroValor">Otro Valor</label>
            <span></span>
        </div>
    </div>
    <input type="hidden" name="summaa" id="summaa" value="<?php echo $valor_etps; ?>">
</div>

<script type="text/javascript">

    var valor_total = new Array();

    function numberWithCommas(formatoNumero) {
        return formatoNumero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $('.etapps').change(function(){

        var suma_etapa = 0;

        valor_etapa = $('[name="etpass[]"]:checked').map(function () {
                                return $(this).data('valor_etapa')
                       }).get();

                      
        //alert("cantidad elementos: "+valor_etapa.length);

        for (let index = 0; index < valor_etapa.length; index++) {
            suma_etapa = parseInt(suma_etapa) + parseInt(valor_etapa[index]);   
        }

        $('#SumTotal').val(numberWithCommas(suma_etapa));
        $('#summaa').val(suma_etapa);
        
    });

    $('#checkedOtroValor').change(function(){
        var valor_otro = $('input:checkbox[name=checkedOtroValor]:checked').val();

        if(valor_otro==1){
            $('#valorDiferente').fadeIn(100);
        }
        else{
            $('#valorDiferente').fadeOut(100);
        }
    });
</script>

<div class="form-group" id="valorDiferente" style="display: <?php echo $ver_otroValor; ?>">
    <label for="txtOtroValor" class="font-weight-bold">Otro Valor*</label>
    <input type="text" class="form-control" id="txtOtroValor" name="txtOtroValor" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $act_referencia; ?>" required>
    <span class="help-block" id="error"></span>            
</div>




