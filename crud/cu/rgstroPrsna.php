<?php
/**
 * Karen Yuliana Palacio Minú
 * 11 de Enero 2020 11:54am
 * Registro Persona
 */
include('prcsos/prsna/rgstroPrsna.php');

$personaSistema = $_SESSION['idusuario'];

$textNombres=$_REQUEST['textNombres'];
$textPrimerApellido=$_REQUEST['textPrimerApellido'];
$textSegundoApellido=$_REQUEST['textSegundoApellido'];
$selTipoIdentificacion=$_REQUEST['selTipoIdentificacion'];
$textIdentificacion=$_REQUEST['textIdentificacion'];
$selEntidad=$_REQUEST['selEntidad'];
$chkgenero=$_REQUEST['chkgenero'];
$chkestado=$_REQUEST['chkestado'];

$registroPersona= new RgstroPrsna();

$registroPersona->setNombrePersona($textNombres);
$registroPersona->setPrimerApellidoPersona($textPrimerApellido);
$registroPersona->setSegundoApellidoPersona($textSegundoApellido);
$registroPersona->setTipoIdentificacionPersona($selTipoIdentificacion);
$registroPersona->setIdentificacionPersona($textIdentificacion);
$registroPersona->setGeneroPersona($chkgenero);
$registroPersona->setEstadoPersona($chkestado);
$registroPersona->setPersonaSistema($personaSistema);
$registroPersona->setEntidadPersona($selEntidad);

echo $registroPersona->insertPersona();

?>