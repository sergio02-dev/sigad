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
    echo $sed_nombre; 
    echo $ofi_nombre;
    echo $equi_nombre;
    echo $deq_descripcion;
    echo $fun_cantidad;
    echo $fun_valorunitario;
    echo $estado;
    echo $are_nombre;
    echo $fac_nombre;

    



?>
<style>
    .modal-content<?php echo $acp_codigo; ?> {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: .3rem;
        outline: 0;
    }
</style>

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


    <table style = "padding-left:50px">
        <tr>
            <th><strong>Sede:<br></strong><?php echo $sed_nombre;?></th>
            <th><strong>Vicerrectoria:<br></strong><?php echo $ent_nombre;?></th>
            <th><strong>Facultad:<br></strong><?php echo $fac_nombre;?></th>
            <th><strong>Dependencia:<br></strong><?php echo $ofi_nombre;?></th>
            <th><strong>Area:<br></strong><?php echo $are_nombre;?></th>
        </tr>
        <tr>
            <th><strong>Linea de Equipo:<br></strong><?php echo $lin_nombre;?></th>
            <th><strong>Sublinea de Equipo:<br></strong><?php echo $slin_nombre;?></th>
            <th><strong>Equipo:<br></strong><?php echo $equi_nombre;?></th>
            <th><strong>Descripción:<br></strong><?php echo $deq_descripcion;?></th>
            <th><strong>Cantidad:<br></strong><?php echo $fun_cantidad;?></th>
        </tr>
        <tr>
            <th><strong>Valor Unitario:<br></strong><?php echo $fun_valorunitario;?></th>
            <th><strong>Valor Total:<br></strong><?php echo $valor_total;?></th>
        </tr>


    </table>

    

	
