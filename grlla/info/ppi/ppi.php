<?php
    include('crud/rs/ppi/ppi.php');

    $codigo_fuente = $_REQUEST['codigo_fuente'];
    $codigo_plan = $_REQUEST['codigo_plan'];
    $codigoPpi = $_REQUEST['codigoPpi'];

    $list_recursos = $objPPI->recursos_fuente($codigo_plan, $codigo_fuente);

?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Vigencia</th>
            <th>Recursos</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if($list_recursos){
                foreach($list_recursos as $dta_list_recursos){
                    $ppi_codigo = $dta_list_recursos['ppi_codigo'];
                    $ppi_vigencia = $dta_list_recursos['ppi_vigencia'];
                    $ppi_valor = $dta_list_recursos['ppi_valor'];
        ?>
        <tr>
            <td><?php echo $ppi_vigencia; ?></td>
            <td><?php echo "$".number_format($ppi_valor,0,'','.'); ?></td>
        </tr>
        <?php
                }
            }
        ?>
    </tbody>
</table>