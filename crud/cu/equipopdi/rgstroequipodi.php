<?php
/**
 * Juan sebastian Romero y
 * Sergio Sánchez Salazar
 */
    include('prcsos/equipopdi/rgstroEquipoPdi.php');

    $personaSistema = $_SESSION['idusuario'];
    $selSublineaEquipo= $_REQUEST['selSublineaEquipo'];
    $selEquipo = $_REQUEST['selEquipo'];
    $selCaracteristicas = $_REQUEST['selCaracteristicas'];
    $selValorUnitario = $_REQUEST['selValorUnitario'];
    

    $registroequipopdi = new RgstroEquipoPdi();

    $registroequipopdi ->setPersonaSistema($personaSistema);
    $registroequipopdi ->setcodigoSublinea($selSublineaEquipo);
    $registroequipopdi ->setEquipoNombre($selEquipo);
    $registroequipopdi ->setCaracteristicaNombre($selCaracteristicas);
    $registroequipopdi ->setValorunitario($selValorUnitario);


    echo $registroequipopdi ->insertEquipoPdi()
?>