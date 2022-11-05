<?php
/**
 * Karen Yuliana Palacio Minú
 * 13 de Enero 2020 06:18pm
 * Crear Usuario y perfiles 
 */

 include('prcsos/prsna/updtePrflPrsna.php');

 $personaSistema = $_SESSION['idusuario'];

 $textUsuario=$_REQUEST['textUsuario'];
 $textPass=$_REQUEST['textPass'];
 $selPerfil=$_REQUEST['selPerfil'];
 $sistema=$_REQUEST['sistema'];
 $per_codigo=$_REQUEST['per_codigo'];
 $use_codigo=$_REQUEST['use_codigo'];

 $cantidad=count($sistema);
 //echo "---> ".$cantidad;
 //print_r($sistema);

 $updatePerfilPersona= new UpdtePrflPrsna();

 $updatePerfilPersona->setCodigoPersona($per_codigo);
 $updatePerfilPersona->setSistema($sistema);
 $updatePerfilPersona->setAlias($textUsuario);
 $updatePerfilPersona->setContrasenia($textPass);
 $updatePerfilPersona->setPerfil($selPerfil);
 $updatePerfilPersona->setPersonaSistema($personaSistema);
 $updatePerfilPersona->setCantidadInsert($cantidad);
 $updatePerfilPersona->setCodigoUsuario($use_codigo);

 echo $updatePerfilPersona->updatePrflPrsna();


?>