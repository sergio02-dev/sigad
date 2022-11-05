<?php
include('crud/rs/plnccion.php');
$codigo_accion=$_REQUEST['codigo_accion'];


$listadoEncargadoAccion=$objPlanAccion->lista_encargado_accion($codigo_accion);
?>
<table>
    <tr>
       <th>No°</th>
       <th>Encargados</th> 
    </tr>
    <?php
    if($listadoEncargadoAccion){
        $numero=1;
        foreach ($listadoEncargadoAccion as $data_listadoEncargadoAccion) {
            $aen_codigo=$data_listadoEncargadoAccion['aen_codigo'];
            $per_nombre=$data_listadoEncargadoAccion['per_nombre'];
            $per_primerapellido=$data_listadoEncargadoAccion['per_primerapellido'];
            $per_segundoapellido=$data_listadoEncargadoAccion['per_segundoapellido'];

            $persona=$per_nombre." ".$per_primerapellido." ".$per_segundoapellido;
    ?>
    <tr>
        <td><?php echo $numero; ?></td>
        <td><?php echo $persona; ?></td>
    </tr>
    <?php
        $numero++;
        }
    }
    else{
    ?>
    <tr>
        <td colspan="2">No Hay Encargados </td>
    </tr>
    <?php 
    }

    ?>
    
</table>