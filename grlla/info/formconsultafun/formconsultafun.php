<?php

    //$fun_codigo = $_REQUEST['fun_codigo'];
    $sed_nombre = $_REQUEST['sed_nombre'];
    $ofi_nombre = $_REQUEST['ofi_nombre'];
    $equi_nombre = $_REQUEST['equi_nombre'];
    $deq_descripcion = $_REQUEST['deq_descripcion'];
    $fun_cantidad = $_REQUEST['fun_cantidad'];
    $fun_valorunitario = $_REQUEST['fun_valorunitario'];
    $estado = $_REQUEST['estado'];
    $are_nombre = $_REQUEST['are_nombre'];
    $ent_nombre = $_REQUEST['ent_nombre'];
    $fac_nombre = $_REQUEST['fac_nombre'];
    $lin_nombre = $_REQUEST['lin_nombre'];
    $slin_nombre = $_REQUEST['slin_nombre'];
    $valor_total = $fun_cantidad * $fun_valorunitario;
	$personaSistema = $_SESSION['idusuario'];
    //echo $fun_codigo;
?>


        <!-- **********************          Inicio Modal Forma    *********************************** -->
        <div class="modal fade" tabindex="-1" id="frmModal<?php echo $acp_codigo; ?>" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content<?php echo $acp_codigo; ?>">
                    Cargando...
                </div>
            </div>
        </div>
        <!-- **********************          Fin Modal Forma       *********************************** -->

        <!-- **********************          Inicio Modal Forma    *********************************** -->
        <div class="modal fade" tabindex="-1" id="frmModalEtapa<?php echo $acp_codigo; ?>" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-contentEtapa<?php echo $acp_codigo; ?>">
                    Cargando...
                </div>
            </div>
        </div>
        <!-- **********************          Fin Modal Forma       *********************************** -->


        <table>
        <tr>
            <th ><strong>Sede:</strong> <?php echo $sed_nombre; ?> </th>
            <th><strong>Vicerrectoria:</strong> <?php echo $ent_nombre; ?> </th>
            <th><strong>Facultad:</strong> <?php echo $fac_nombre; ?> </th>
            <th colspan="2"><strong>Dependencia:</strong> <?php echo $ofi_nombre; ?> </th>
            <th><strong>Area:</strong> <?php echo $are_nombre; ?> </th>
           
        </tr>
        
        <tr>
            <td colspan="2">
                <strong>Linea equipo:</strong><br>
                <?php echo $lin_nombre; ?>
            </td>
            <td colspan="2">
                <strong>Sublinea equipo:</strong><br>
                <?php echo $slin_nombre; ?>
            </td>
            <td colspan="2">
                <strong>Equipo:</strong><br>
                <?php echo $equi_nombre; ?>
            </td>
            
        </tr>
        <tr>
            <td colspan="2">
                <strong>Descripcion:</strong><br>
                <?php echo $deq_descripcion; ?>
            </td>
            <td colspan="1">
                <strong>Cantidad:</strong><br>
                <?php  echo $fun_cantidad?>
            </td>
            <td colspan="2">
                <strong>Valor unitario:</strong><br>
                <?php  echo  "$".number_format($fun_valorunitario, 0, ',', '.'); ?>
            </td>
            <td colspan="1">
                <strong>Valor total:</strong><br>
                <?php   echo  "$".number_format($valor_total, 0, ',', '.');?>
            </td>
        </tr>
    </table> <br>   



    

	
