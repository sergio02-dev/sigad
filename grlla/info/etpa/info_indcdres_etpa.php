<?php
    include('crud/rs/plnccion.php');

    $codigo_accion = $_REQUEST['codigo_accion'];

    $indicadores = $objPlanAccion->indicadores_accion($codigo_accion);

    if($indicadores){
        foreach($indicadores as $dta_indcadores){
            $ind_codigo = $dta_indcadores['ind_codigo'];
            $ind_unidadmedida = $dta_indcadores['ind_unidadmedida'];
            $ind_lineabase = $dta_indcadores['ind_lineabase'];
            $ind_metaresultado = $dta_indcadores['ind_metaresultado'];
            $ind_accion = $dta_indcadores['ind_accion']; 
            $ind_estado = $dta_indcadores['ind_estado'];
            $ind_tipocomportamiento = $dta_indcadores['ind_tipocomportamiento'];
            $ind_tendencia = $dta_indcadores['ind_tendencia'];
            $ind_sede = $dta_indcadores['ind_sede'];

            $nombre_sede = $objPlanAccion->nombre_sede($ind_sede);

            $comportamiento = $objPlanAccion->comportamientoNivelTres($ind_tipocomportamiento);

            $tendencia = $objPlanAccion->tendenciaNivelTres($ind_tendencia);
?>

<table class="table table-striped table-bordered table-sm">
    <tr>
        <td><strong>Indicador:</strong> <?php echo $ind_unidadmedida; ?></td>
        <td rowspan="6">
            <table class="table table-striped table-bordered table-sm">
                <tr>
                    <th>Vigencia</th>
                    <th>Unidad</th>
                    <th>Presupuesto</th>
                </tr>
                <?php
                    $indicador_vigencia = $objPlanAccion->indicador_vigencia($ind_codigo);
                    if($indicador_vigencia){
                        foreach ($indicador_vigencia as $dta_indcdor_vgncia) {
                            $ivi_codigo = $dta_indcdor_vgncia['ivi_codigo'];
                            $ivi_indicador = $dta_indcdor_vgncia['ivi_indicador'];
                            $ivi_valorlogrado = $dta_indcdor_vgncia['ivi_valorlogrado'];
                            $ivi_presupuesto = $dta_indcdor_vgncia['ivi_presupuesto'];
                            $ivi_vigencia = $dta_indcdor_vgncia['ivi_vigencia'];

                ?>
                <tr>
                    <td><?php echo $ivi_vigencia; ?></td>
                    <td><?php echo $ivi_valorlogrado; ?></td>
                    <td><?php echo "$".number_format($ivi_presupuesto,0,'','.'); ?></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td><strong>Sede:</strong> <?php echo $nombre_sede; ?></td>
    </tr>
    <tr>
        <td><strong>Linea Base:</strong> <?php echo $ind_lineabase; ?></td>
    </tr>
    <tr>
        <td><strong>Meta Resultado:</strong> <?php echo $ind_metaresultado; ?></td>
    </tr>
    <tr>
        <td><strong>Comportamiento:</strong> <?php echo $comportamiento; ?></td>
    </tr>
    <tr>
        <td><strong>Tendencia:</strong> <?php echo $tendencia; ?></td>
    </tr>
</table>
<?php
        }
    }
?>