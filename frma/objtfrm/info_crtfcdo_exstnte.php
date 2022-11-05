<?php
    include('crud/rs/crtfcdos.php');

    $codigo_certificado = $_REQUEST['codigo_certificado'];
    $certificado = $_REQUEST['certificado'];

    $actvdades_certificado = $objRscrtfcdo->actvdades_certificado($codigo_certificado);

    $valor_certificado = $objRscrtfcdo->valor_certificado($codigo_certificado);
?>
<br>
<h6><strong>Certificado <?php echo $certificado; ?> Valor $<?php echo number_format($valor_certificado,0,'','.'); ?></strong></h6><br>
<?php
    if($actvdades_certificado){
        foreach ($actvdades_certificado as $data_actividad_certificado) {
            $cee_actividad = $data_actividad_certificado['cee_actividad'];
            $acp_codigo = $data_actividad_certificado['acp_codigo']; 
            $acp_referencia = $data_actividad_certificado['acp_referencia'];
            $acp_numero = $data_actividad_certificado['acp_numero'];
            $acp_descripcion = $data_actividad_certificado['acp_descripcion'];

?>
    <span>&nbsp;<strong><?php echo $acp_referencia.".".$acp_numero." ".$acp_descripcion; ?></strong></span><br><br>
<?php
            $etpas_certificado = $objRscrtfcdo->etpas_certificado($codigo_certificado, $cee_actividad);
            if($etpas_certificado){
?>
            <table class="table table-hover table-sm">
                <tr>
                    <th>No.</th>
                    <th>Etapa</th>
                    <th>Valor Etapa</th>
                </tr>
                
<?php   
                $num_etpa = 1;
                foreach ($etpas_certificado as $data_etapas_actividad) {
                    $cee_certificado = $data_etapas_actividad['cee_certificado'];
                    $cee_actividad = $data_etapas_actividad['cee_actividad'];
                    $cee_etapa = $data_etapas_actividad['cee_etapa'];
                    $poa_referencia = $data_etapas_actividad['poa_referencia']; 
                    $poa_numero = $data_etapas_actividad['poa_numero'];
                    $poa_objeto = $data_etapas_actividad['poa_objeto'];
                    $cee_valor = $data_etapas_actividad['cee_valor'];

                    $etapa_descripcion = $poa_referencia.".".$poa_numero." ".$poa_objeto;

?>
                <tr>
                    <td><?php echo $num_etpa; ?></td>
                    <td><?php echo $etapa_descripcion; ?></td>
                    <td><?php echo "$".number_format($cee_valor,0,'','.'); ?></td>
                </tr>
<?php   
                $num_etpa++;
                }
?>
            </table>
<?php
            }
        }
    }
?>

<label for="txtValorReducir" class="font-weight-bold">Valor a Reducir *</label>
<input type="number" class="form-control caja_texto_sizer" id="txtValorReducir" name="txtValorReducir" aria-describedby="textHelp" data-rule-required="true" value="<?php echo $act_certificado; ?>" required>
<input type="hidden" name="certificadoMod" id="certificadoMod" value="<?php echo $certificado; ?>">
<span class="help-block" id="error"></span>