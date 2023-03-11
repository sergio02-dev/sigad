<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/equipopdi/rgstroEquipoPdi.php');

    $personaSistema = $_SESSION['idusuario'];
    $selSublineaEquipo= $_REQUEST['selSublineaEquipo'];
    $txtEquipo = $_REQUEST['txtEquipo'];
    $txtCaracteristicas = $_REQUEST['txtCaracteristicas'];
    $selValorUnitario= str_replace('.','',$_REQUEST['selValorUnitario']);
    

    $registroequipopdi = new RgstroEquipoPdi();

    

    $registroequipopdi ->setPersonaSistema($personaSistema);
    $registroequipopdi ->setcodigoSublinea($selSublineaEquipo);
    $registroequipopdi ->setEquipoNombre($txtEquipo);
    $registroequipopdi ->setCaracteristicaNombre($txtCaracteristicas);
    $registroequipopdi ->setValorunitario($selValorUnitario);


    echo $registroequipopdi ->insertEquipoPdi()
?>