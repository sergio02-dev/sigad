<?php
/**
 * Karen Yuliana Palacio Minú
 * 13 de Enero 2020 06:18pm
 * Crear Usuario y perfiles 
 */

 include('prcsos/prsna/rgstroPrflPrsna.php');

 $personaSistema = $_SESSION['idusuario'];

 $textUsuario=$_REQUEST['textUsuario'];
 $textPass=$_REQUEST['textPass'];
 $selPerfil=$_REQUEST['selPerfil'];
 $sistema=$_REQUEST['sistema'];
 $per_codigo=$_REQUEST['per_codigo'];

 $cantidad=count($sistema);
 //echo "---> ".$cantidad;
 //print_r($sistema);

 $registroPerfilPersona= new RgstroPrflPrsna();

 $registroPerfilPersona->setCodigoPersona($per_codigo);
 $registroPerfilPersona->setSistema($sistema);
 $registroPerfilPersona->setAlias($textUsuario);
 $registroPerfilPersona->setContrasenia($textPass);
 $registroPerfilPersona->setPerfil($selPerfil);
 $registroPerfilPersona->setPersonaSistema($personaSistema);
 $registroPerfilPersona->setCantidadInsert($cantidad);

 echo $registroPerfilPersona->insertPrflPrsna();


?>