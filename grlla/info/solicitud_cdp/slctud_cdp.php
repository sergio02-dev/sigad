<?php
    include('crud/rs/solicitud_cdp/solicitud_cdp.php');
    include('crud/rs/solicitud_cdp/jclsfcdoreslinix.php'); 


    $codigo_cdp = $_REQUEST['codigo_cdp'];

    $info_cdp = $objSolicitudCdp->info_cdp($codigo_cdp);    
?>

<table>
    <tr>
        <th>No.</th>
        <th>Actividad</th>
        <th>Etapa</th>
        <th>Valor</th>
        <th colspan="2">Clasificadores</th>
    </tr>
    <?php
        if($info_cdp){
            $num_sol = 1;
            foreach($info_cdp as $dta_inf_cdp){
                $aes_codigo = $dta_inf_cdp['aes_codigo'];
                $aes_solicitud = $dta_inf_cdp['aes_solicitud'];
                $aes_actividad = $dta_inf_cdp['aes_actividad'];
                $aes_etapa = $dta_inf_cdp['aes_etapa'];
                $aes_valoretapa = $dta_inf_cdp['aes_valoretapa'];
                $aes_otrovalor = $dta_inf_cdp['aes_otrovalor'];
                $acp_descripcion = $dta_inf_cdp['acp_descripcion'];
                $acp_referencia = $dta_inf_cdp['acp_referencia'];
                $acp_numero = $dta_inf_cdp['acp_numero'];
                $poa_referencia = $dta_inf_cdp['poa_referencia'];
                $poa_numero = $dta_inf_cdp['poa_numero'];
                $poa_objeto = $dta_inf_cdp['poa_objeto'];

                $actividad = $acp_referencia.".".$acp_numero." ".$acp_descripcion;

                $etapa = $poa_referencia.".".$poa_numero." ".$poa_objeto;
    ?>
    <tr>
        <td><?php echo $num_sol; ?></td>
        <td><?php echo $actividad; ?></td>
        <td><?php echo $etapa; ?></td>
        <td><?php echo "$".number_format($aes_valoretapa,0,'','.'); ?></td>     
        <td colspan="2">
            <table>
                <tr>
                    <th>Clasificador </th>
                    <th>Valor</th>
                    
                </tr>
            <?php 
                $clasificador_etapa_solicitud = $objSolicitudCdp->clasificador_etapa_solicitud($codigo_cdp, $aes_etapa);
                if($clasificador_etapa_solicitud){
                    foreach ($clasificador_etapa_solicitud as $dta_clsfcdres) {
                        $esc_codigo = $dta_clsfcdres['esc_codigo'];
                        $esc_clasificador = $dta_clsfcdres['esc_clasificador'];
                        $esc_valor = $dta_clsfcdres['esc_valor'];

                        
                        list($nombre, $numero) = $objConsultaLinix->nmbre_clsfcdor($esc_clasificador);
                        //list($nombre, $numero) = $objSolicitudCdp->nmbre_clsfcdor($esc_clasificador);
            ?>
                <tr>
                    <td><?php echo $numero." - ".$nombre; ?></td>
                    <td><?php echo "$".number_format($esc_valor,0,'','.'); ?></td>
                </tr>
            <?php
                    }
                }
            
            ?>
            </table>
        </td> 
    </tr>
    <?php
            $num_sol++;
            }
        }
        else{
    ?>
    <tr>
        <td colspan="4"></td>
    </tr>
    <?php
        }
    ?>
</table>

<br>

<table>
    <tr>
        <th>No.</th>
        <th>Vigencia</th>
        <th>Fuente de Financiaci&oacute;n</th>
        <th>Valor</th>
    </tr>
    <?php
        $list_fntes_slictud = $objSolicitudCdp->fuentes_solctud($codigo_cdp);
        if($list_fntes_slictud){
            $num_fuente = 1;
            foreach ($list_fntes_slictud as $dta_fntes_financiacion) {
                $aso_codigo = $dta_fntes_financiacion['aso_codigo'];
                $asre_vigenciarecurso = $dta_fntes_financiacion['asre_vigenciarecurso'];
                $ffi_nombre = $dta_fntes_financiacion['ffi_nombre'];
                $aso_valor = $dta_fntes_financiacion['aso_valor'];

    ?>
    <tr>
        <td><?php echo $num_fuente; ?></td>
        <td><?php echo $asre_vigenciarecurso; ?></td>
        <td><?php echo str_replace('INV -','', $ffi_nombre); ?></td>
        <td><?php echo "$".number_format($aso_valor,0,'','.'); ?></td>
    </tr>
    <?php
            $num_fuente++;
            }  
        }
    ?>
</table>
